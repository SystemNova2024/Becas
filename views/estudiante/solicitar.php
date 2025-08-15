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
                'options' => ['enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate' => true],
                'fieldConfig' => [
                    'template' => '<div class="form-floating mb-4">{input}{label}{error}</div>',
                    'labelOptions' => ['class' => 'form-label text-secondary'],
                    'inputOptions' => ['class' => 'form-control rounded-3 shadow-sm'],
                    'errorOptions' => ['class' => 'text-danger small mt-1'],
                ],
            ]); ?>

            <?php if ($solicitud->hasErrors()): ?>
                <div class="alert alert-danger shadow-sm rounded-3">
                    <ul class="mb-0">
                        <?php foreach ($solicitud->getErrors() as $errores): ?>
                            <?php foreach ($errores as $error): ?>
                                <li><?= Html::encode($error) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($beca->requiere_justificacion): ?>
                <?= $form->field($solicitud, 'justificacion')->textarea([
                    'rows' => 4,
                    'placeholder' => 'Explica brevemente por qué necesitas esta beca...',
                    'class' => 'form-control rounded-3 shadow-sm',
                    'style' => 'height: 120px;',
                ])->label('Justificación') ?>
            <?php endif; ?>

            <!-- NUEVO APARTADO FIJO PARA SUBIR DOCUMENTACIÓN -->
            <div class="mt-5">
                <h4 class="mb-3"><i class="bi bi-paperclip me-2"></i> Subir Documentación</h4>
                <p class="text-muted small">Adjunta tus documentos en formato PDF o imagen (JPG, JPEG, PNG).</p>

                <?= $form->field($solicitud, 'archivo[]')->fileInput([
                    'multiple' => true,
                    'accept' => '.pdf,.jpg,.jpeg,.png',
                    'class' => 'form-control rounded-3 shadow-sm'
                ])->label(false) ?>
            </div>
            <!-- FIN NUEVO APARTADO -->

            <div class="d-flex justify-content-center mt-4">
                <?= Html::submitButton('<i class="bi bi-send-fill me-2"></i>Enviar Solicitud', [
                    'class' => 'btn btn-outline-primary btn-lg rounded-pill px-5 py-2 shadow-sm'
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
