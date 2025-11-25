<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$baseUrl = Yii::$app->request->baseUrl;

$this->registerLinkTag(['rel' => 'manifest', 'href' => $baseUrl . '/manifest.json']);
$this->registerMetaTag(['name' => 'theme-color', 'content' => '#2B6CB0']);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link rel="preload" href="<?= $baseUrl ?>/css/site.css" as="style">
    <link rel="preload" href="<?= $baseUrl ?>/manifest.json" as="manifest">

    <style>
        :root {
            --bg-general: #ffffff;
            --color-primary: #03045e;
            --color-secondary: #023e8a;
            --color-accent: #0077b6;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        body {
            background-color: var(--bg-general);
            font-family: 'Inter', sans-serif;
            color: #2d3748;
        }
        .navbar {
            box-shadow: var(--shadow);
        }
        #btnInstalar {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            border-radius: 50px;
            padding: 12px 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            font-weight: 600;
            border: none;
            background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
            color: white;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => 'Sistema de Becas',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-md navbar-dark fixed-top',
            'style' => 'background:linear-gradient(135deg,var(--color-primary),var(--color-secondary));'
        ]
    ]);

    $menuItems = [];

    if (!Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Becas', 'url' => ['/site/becas']];
        $menuItems[] = ['label' => 'Usuarios', 'url' => ['/usuarios/index']];
        $menuItems[] =
            '<li>' .
            Html::beginForm(['/site/logout'], 'post') .
            Html::submitButton(
                'Cerrar Sesión (' . Html::encode(Yii::$app->user->identity->nombre_completo) . ')',
                ['class' => 'btn btn-link logout', 'style' => 'color:white;text-decoration:none;']
            ) .
            Html::endForm() .
            '</li>';
    } else {
        $menuItems[] = ['label' => 'Iniciar Sesión', 'url' => ['/site/login']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" style="padding-top:100px;">
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-4"
        style="background:linear-gradient(135deg,var(--color-primary),var(--color-secondary));color:white;">
    <div class="container text-center">
        <strong>&copy; Universidad Tecnológica de Huejotzingo <?= date('Y') ?></strong><br>
        <small>Sistema Institucional de Gestión de Becas</small>
    </div>
</footer>

<!-- ================== SERVICE WORKER & SYNC ================== -->
<?php
// Añadimos la carga del helper IDB (si lo sirves desde /js/idb-helper.js)
?>
<script>
(function() {
    'use strict';

    // Registrar Service Worker con scope raíz
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('<?= $baseUrl ?>/service-worker.js', { scope: '/' })
                .then(reg => {
                    console.log('SW registrado con scope:', reg.scope);
                })
                .catch(err => console.warn('Error registrando SW:', err));
        });

        // Escuchar mensajes desde el SW
        navigator.serviceWorker.addEventListener('message', function(ev) {
            if (ev.data?.type === 'RELOAD') {
                console.log('SW pide recarga');
                // Si estamos online, recargar con forzado de cache
                if (navigator.onLine) location.reload(true);
                else location.reload();
            }
        });
    }

    // Detectar reconexión y disparar sincronización local (intento de logins pendientes)
    async function trySyncPendingLogins() {
        // Esperar a que IDBHelper esté disponible
        if (!window.IDBHelper) {
            // reintentar en breve si no está cargado todavía
            setTimeout(trySyncPendingLogins, 500);
            return;
        }

        try {
            const pendientes = await IDBHelper.getRecordsByType('login-pendiente');
            if (!pendientes || pendientes.length === 0) return;

            console.log('Intentando sincronizar logins pendientes:', pendientes.length);
            for (const reg of pendientes) {
                try {
                    // Enviamos el registro al endpoint que verifica / inicia sesión
                    // Enviamos email + passwordHash (backend debe aceptar y proceder)
                    const resp = await fetch('/site/login-offline-sync', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            email: reg.correo,
                            passwordHash: reg.passwordHash
                        })
                    });

                    const json = await resp.json().catch(()=>null);
                    if (resp.ok && json && (json.ok === true || json.logged === true)) {
                        // Eliminamos el registro sincronizado y redirigimos a home
                        await IDBHelper.deleteRecord(reg.id);
                        console.log('Login sincronizado para', reg.correo);
                        // Redirigir al inicio para tomar la sesión del servidor
                        window.location.href = '/';
                        return;
                    } else {
                        console.warn('No se pudo sincronizar login para', reg.correo, json);
                        // Si no fue OK, podemos decidir eliminarlo o mantenerlo para reintento
                    }
                } catch (e) {
                    console.warn('Error sincronizando registro', reg, e);
                }
            }
        } catch (e) {
            console.warn('Error leyendo registros pendientes', e);
        }
    }

    window.addEventListener('online', () => {
        console.log('Conexión restaurada — intentando sincronizar pendientes');
        trySyncPendingLogins();
    });

    // Intento inicial de sincronizar si ya estamos online al cargar la página
    if (navigator.onLine) {
        setTimeout(trySyncPendingLogins, 800);
    }
})();
</script>

<!-- Botón instalar -->
<button id="btnInstalar" class="btn btn-primary shadow-lg" style="display:none">
    <i class="fas fa-download"></i> Instalar App
</button>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
