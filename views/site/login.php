<?php
/**
 * Login – Sistema de Becas UTH
 */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Iniciar Sesión - Sistema de Becas';
?>

<!-- ======== ESTILOS ======== -->
<style>
:root {
    --color-primary: #0056b3;
    --color-accent: #00c9a7;
    --color-light: #f8f9fa;
    --text-primary: #343a40;
    --shadow: 0 8px 24px rgba(0, 0, 0, .08);
    --shadow-hover: 0 12px 32px rgba(0, 0, 0, .15);
}

.login-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-light) 100%);
}

.login-card {
    width: 100%;
    max-width: 440px;
    border-radius: 20px;
    box-shadow: var(--shadow-hover);
    background: linear-gradient(135deg, var(--color-light), #fff);
    padding: 3rem 2.5rem;
    border: 2px solid var(--color-accent);
}

.login-header {
    text-align: center;
    margin-bottom: 2rem;
}

.login-icon {
    background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.login-title {
    font-weight: 700;
    color: var(--color-primary);
    font-size: 1.8rem;
}

.form-control {
    border: 1px solid var(--color-accent);
    border-radius: 8px;
    padding: 12px;
}

.btn-primary {
    background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
    border: none;
    font-weight: bold;
    padding: 14px;
    border-radius: 8px;
}

/* OFFLINE UI */
.offline-indicator {
    display: none;
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    color: #856404;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 1rem;
    font-weight: 600;
    text-align: center;
}

.offline-indicator.show { display: block; }

.offline-options {
    display: none;
    margin-top: 1.5rem;
}

.offline-options.show { display: block; }

.offline-btn {
    background: #6c757d;
    color: white;
}

.status-message {
    margin-top: 1rem;
    display: none;
    padding: 10px;
    border-radius: 5px;
}
.status-success {
    background: #d4edda;
    color: #155724;
}
.status-error {
    background: #f8d7da;
    color: #721c24;
}
</style>

<div class="login-wrapper">
    <div class="login-card">

        <div id="offlineIndicator" class="offline-indicator">
            <i class="fas fa-wifi-slash"></i> Estás sin conexión — puedes iniciar offline
        </div>

        <div class="login-header">
            <div class="login-icon">
                <i class="fa fa-user-lock fa-2x text-white"></i>
            </div>
            <h1 class="login-title">Acceso al sistema</h1>
        </div>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableClientValidation' => true,
        ]) ?>

        <!-- CORREO -->
        <?= $form->field($model, 'correo')->textInput([
            'id' => 'login-correo',
            'placeholder' => 'Correo institucional',
        ])->label(false) ?>

        <!-- PASSWORD -->
        <?= $form->field($model, 'password')->passwordInput([
            'id' => 'login-password',
            'placeholder' => 'Contraseña',
        ])->label(false) ?>

        <!-- REMEMBER -->
        <?= $form->field($model, 'rememberMe')->checkbox(['id' => 'remember-me']) ?>

        <!-- BOTÓN LOGIN -->
        <div class="d-grid">
            <?= Html::submitButton('Acceder al sistema', [
                'class' => 'btn btn-primary',
                'id' => 'login-button',
            ]) ?>
        </div>

        <?php ActiveForm::end() ?>

        <!-- BOTÓN USAR CREDENCIALES OFFLINE -->
        <div id="offlineOptions" class="offline-options">
            <button id="offline-login-btn" class="btn offline-btn w-100">
                <i class="fas fa-database"></i> Usar credenciales guardadas
            </button>
        </div>

        <div id="loginStatus" class="status-message"></div>

    </div>
</div>

<!-- ======== JAVASCRIPT OFFLINE ======== -->
<?php
$js = <<<JS

function showStatus(msg, type) {
    const div = document.getElementById('loginStatus');
    div.textContent = msg;
    div.className = 'status-message status-' + type;
    div.style.display = 'block';
}

function hideStatus() {
    document.getElementById('loginStatus').style.display = 'none';
}

function updateConnection() {
    const offline = document.getElementById('offlineIndicator');
    const opt = document.getElementById('offlineOptions');
    const btn = document.getElementById('login-button');

    if (!navigator.onLine) {
        offline.classList.add('show');
        opt.classList.add('show');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-ban"></i> Sin conexión';
    } else {
        offline.classList.remove('show');
        opt.classList.remove('show');
        btn.disabled = false;
        btn.innerHTML = 'Acceder al sistema';

        // AUTO LOGIN CUANDO VUELVE LA CONEXIÓN
        autoLoginOnline();
    }
}

async function autoLoginOnline() {
    const correo = document.getElementById('login-correo').value;
    const pass = document.getElementById('login-password').value;

    if (correo && pass) {
        showStatus('Conexión restaurada. Iniciando sesión...', 'success');
        setTimeout(() => {
            document.getElementById('login-button').click();
        }, 800);
    }
}

/* ============================================
 * LOGIN OFFLINE (USAR CREDENCIALES GUARDADAS)
 * ============================================ */
document.getElementById('offline-login-btn').addEventListener('click', async () => {
    try {
        const registros = await IDBHelper.getRecordsByType('credencial');

        if (registros.length === 0) {
            showStatus('No hay credenciales guardadas.', 'error');
            return;
        }

        const cred = registros[0];

        document.getElementById('login-correo').value = cred.correo;
        document.getElementById('login-password').value = cred.password;

        showStatus('Credenciales cargadas. Cuando tengas conexión, inicia automáticamente.', 'success');

    } catch (e) {
        showStatus('Error leyendo IndexedDB', 'error');
        console.error(e);
    }
});

/* ============================================
 * GUARDAR CREDENCIALES TRAS LOGIN EXITOSO
 * ============================================ */
document.getElementById('login-form').addEventListener('submit', () => {
    if (!navigator.onLine) return;

    const correo = document.getElementById('login-correo').value;
    const pass = document.getElementById('login-password').value;

    if (correo && pass && document.getElementById('remember-me').checked) {

        IDBHelper.deleteRecordsByType('credencial').then(() => {
            IDBHelper.addRecord({
                tipo: 'credencial',
                correo: correo,
                password: pass
            });
        });
    }
});

/* ============================================
 * CARGAR CREDENCIALES AUTOMÁTICAMENTE SI ESTOY OFFLINE
 * ============================================ */
document.addEventListener('DOMContentLoaded', async () => {
    updateConnection();

    if (!navigator.onLine) {
        const registros = await IDBHelper.getRecordsByType('credencial');
        if (registros.length > 0) {
            const c = registros[0];
            document.getElementById('login-correo').value = c.correo;
            document.getElementById('login-password').value = c.password;
            showStatus('Credenciales cargadas automáticamente (offline)', 'success');
        }
    }
});

window.addEventListener('online', updateConnection);
window.addEventListener('offline', updateConnection);

JS;

$this->registerJs($js);
?>
