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
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php

    NavBar::begin([
        'brandLabel' => 'Becas',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark fixed-top', 'style' => 'background-color: #4A0000;']
    ]);

    $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
    ];

    if (!Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Becas', 'url' => ['/site/becas']];
        $menuItems[] = ['label' => 'Usuarios', 'url' => ['/usuarios/index']]; // <-- Página de Usuarios

        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->nombre_completo . ')',
                ['class' => 'btn btn-link logout', 'style' => 'color: #fff; text-decoration: none;']
            )
            . Html::endForm()
            . '</li>';
    } else {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>
</header>


<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3" style="background-color: #4A0000; color: #FFF8DC;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">&copy; Sistema de Becas <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
