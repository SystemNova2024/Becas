<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Iniciar sesión';
// Elimino el breadcrumb y el título Home
?>
<style>
.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #4A0000 0%, #8B0000 100%);
}
.login-card {
    width: 100%;
    max-width: 440px;
    border-radius: 1rem;
    box-shadow: 0 4px 24px rgba(0,0,0,0.15);
    background: #fff;
    padding: 3rem 2.5rem 2.5rem 2.5rem;
}
.login-title {
    font-weight: 700;
    color: #4A0000;
    margin-bottom: 1.5rem;
    text-align: center;
    font-size: 2rem;
}
.input-group-text {
    background: #fff;
    border-right: 0;
}
.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(138,0,0,.15);
    border-color: #8B0000;
}
.btn-primary {
    background: #4A0000;
    border: none;
    font-weight: 600;
    letter-spacing: 1px;
}
.btn-primary:hover {
    background: #8B0000;
}
#togglePassword {
    border-left: 0;
    padding: 0 0.75rem;
    font-size: 1rem;
    background: transparent;
    color: #4A0000;
    box-shadow: none;
}
#eyeIcon {
    font-size: 1.1em;
}
</style>
<div class="login-container">
    <div class="login-card">
        <div class="login-title">
            <i class="fa fa-user-circle fa-lg mb-2"></i><br>
            <?= Html::encode($this->title) ?>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    <?= $form->field($model, 'correo', [
                        'template' => "{input}",
                    ])->textInput([
                        'autofocus' => true,
                        'placeholder' => 'Correo institucional',
                        'class' => 'form-control',
                        'style' => 'border-left:0;'
                    ]) ?>
                </div>
                <div class="invalid-feedback d-block">
                    <?= $model->getFirstError('correo') ?>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group align-items-center">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <?= $form->field($model, 'password', [
                        'template' => "{input}",
                    ])->passwordInput([
                        'id' => 'loginform-password',
                        'placeholder' => 'Contraseña',
                        'class' => 'form-control',
                        'style' => 'border-left:0; border-right:0;'
                    ]) ?>
                    <button type="button" class="btn" id="togglePassword" tabindex="-1">
                        <i class="fa fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                <div class="invalid-feedback d-block">
                    <?= $model->getFirstError('password') ?>
                </div>
            </div>
            <div class="form-check mb-3">
                <?= $form->field($model, 'rememberMe', [
                    'template' => "<div class=\"form-check\">{input} {label}</div>\n<div>{error}</div>",
                ])->checkbox(['class' => 'form-check-input', 'id' => 'rememberMeCheck']) ?>
            </div>
            <div class="d-grid mb-2">
                <?= Html::submitButton('Iniciar sesión', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$this->registerJs(<<<JS
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('loginform-password');
    const eyeIcon = document.getElementById('eyeIcon');
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });
JS);
?>
