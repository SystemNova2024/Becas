<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\Beca $model */

$this->title = 'Actualizar Beca: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Becas', 'url' => ['becas']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h3><i class="bi bi-pencil-square"></i> <?= Html::encode($this->title) ?></h3>

<div class="card p-4 shadow-sm">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'descripcion')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'fecha_inicio')->input('date') ?>
    <?= $form->field($model, 'fecha_fin')->input('date') ?>
    <?= $form->field($model, 'requiere_justificacion')->checkbox() ?>
    <?= $form->field($model, 'requiere_documentos')->checkbox() ?>

    <?php if ($model->archivo_convocatoria): ?>
        <p>Archivo actual: 
            <?= Html::a('Ver archivo', Yii::getAlias('@web') . '/' . $model->archivo_convocatoria, ['target' => '_blank']) ?>
        </p>
    <?php endif; ?>

    <?= $form->field($model, 'archivo_convocatoria')->fileInput() ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancelar', ['becas'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
