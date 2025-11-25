<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Solicitud de Beca: ' . $beca->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Becas Disponibles', 'url' => ['becas']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-sm">
        <div class="card-body p-5">
            <h2 class="mb-4 fw-bold text-center">
                <i class="bi bi-upload me-2"></i> Solicitar Beca: <?= Html::encode($beca->nombre) ?>
            </h2>

            <?php $form = ActiveForm::begin([
                'class' => 'needs-validation',
            ]); ?>

            <!-- Confirmación de beca -->
            <div class="alert alert-info shadow-sm rounded-3 mb-4">
                <h5 class="mb-2">📋 Confirmar Solicitud</h5>
                <p class="mb-0">Estás a punto de solicitar: <strong><?= Html::encode($beca->nombre) ?></strong></p>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <?= Html::submitButton('✓ Solicitar Beca', [
                    'class' => 'btn btn-success btn-lg rounded-pill px-5 py-2 shadow-sm'
                ]) ?>
                <?= Html::a('Cancelar', ['/estudiante/becas'], [
                    'class' => 'btn btn-outline-secondary btn-lg rounded-pill px-5 py-2'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    border-color: #6c757d;
    box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.2);
    transition: all 0.3s ease-in-out;
}
textarea.form-control {
    resize: none;
}
.btn-outline-primary:hover {
    background-color: #0d6efd;
    color: #fff;
    transition: 0.3s;
}
</style>
