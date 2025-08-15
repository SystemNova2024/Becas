<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\Beca $model */

$this->title = 'Crear Nueva Beca';
$this->params['breadcrumbs'][] = ['label' => 'Becas', 'url' => ['becas']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <h2 class="mb-4 text-primary">
                <i class="bi bi-plus-circle me-2"></i> <?= Html::encode($this->title) ?>
            </h2>

            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate' => true],
                'fieldConfig' => [
                    'template' => '<div class="form-floating mb-4">{input}{label}{error}</div>',
                    'labelOptions' => ['class' => 'form-label text-muted'],
                    'inputOptions' => ['class' => 'form-control rounded-3 shadow-sm'],
                    'errorOptions' => ['class' => 'text-danger small mt-1'],
                ],
            ]); ?>

            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Nombre de la beca']) ?>
            <?= $form->field($model, 'descripcion')->textarea(['rows' => 5, 'style' => 'height: 120px;', 'placeholder' => 'Describe brevemente la beca...']) ?>
            <?= $form->field($model, 'requisitos')->textarea(['rows' => 6, 'style' => 'height: 140px;', 'placeholder' => 'Lista los requisitos para aplicar...']) ?>
            <?= $form->field($model, 'procedimiento')->textarea(['rows' => 4, 'style' => 'height: 100px;', 'placeholder' => 'Indica el procedimiento para aplicar...']) ?>
            <?= $form->field($model, 'fecha_inicio')->input('date') ?>
            <?= $form->field($model, 'fecha_fin')->input('date') ?>

            <div class="mb-4">
                <label for="archivo_convocatoria" class="form-label fw-bold">Archivo de Convocatoria</label>
                <?= Html::activeFileInput($model, 'archivo_convocatoria', ['class' => 'form-control form-control-lg rounded-3 shadow-sm']) ?>
            </div>

            <div class="form-check form-switch mb-4">
                <?= Html::activeCheckbox($model, 'requiere_justificacion', [
                    'class' => 'form-check-input',
                    'label' => '¿Requiere justificación?',
                    'labelOptions' => ['class' => 'form-check-label ms-2'],
                ]) ?>
            </div>

            <div class="form-check form-switch mb-4">
                <?= Html::activeCheckbox($model, 'requiere_documentos', [
                    'class' => 'form-check-input',
                    'label' => '¿Requiere documentos?',
                    'labelOptions' => ['class' => 'form-check-label ms-2'],
                ]) ?>
            </div>

            <div class="text-end">
                <?= Html::submitButton('<i class="bi bi-save2-fill me-2"></i>Guardar Beca', [
                    'class' => 'btn btn-primary btn-lg px-4 py-2 rounded-pill shadow'
                ]) ?>
                <?= Html::a('<i class="bi bi-x-circle me-2"></i>Cancelar', ['becas'], [
                    'class' => 'btn btn-secondary btn-lg px-4 py-2 rounded-pill shadow ms-2'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    border-color: #4A00E0;
    box-shadow: 0 0 0 0.2rem rgba(74, 0, 224, 0.2);
    transition: all 0.3s ease-in-out;
}
textarea.form-control {
    resize: none;
}
</style>
