<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_completo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rol_id')->dropDownList([
        1 => 'Coordinador de becas',
        3 => 'Estudiante',
    ], ['prompt' => 'Selecciona un rol']) ?>

    <?= $form->field($model, 'activo')->dropDownList([1 => 'Activo', 0 => 'Inactivo']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
