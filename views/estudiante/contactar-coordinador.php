<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Enviar Notificación al Departamento de Becas';
?>

<div class="container mt-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="bi bi-bell me-2"></i> Enviar Notificación al Departamento
            </h3>
        </div>
        <div class="card-body p-4">
            <div class="alert alert-info">
                <strong>💡 Información:</strong> Si tienes una solicitud de beca y necesitas ayuda, puedes enviar una notificación al departamento desde aquí.
            </div>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'mensaje')->textarea([
                'rows' => 8,
                'class' => 'form-control',
                'placeholder' => 'Escribe tu mensaje al departamento de becas...'
            ])->label('Tu Mensaje') ?>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <?= Html::a('Cancelar', ['solicitudes'], [
                    'class' => 'btn btn-outline-secondary'
                ]) ?>
                <?= Html::submitButton(
                    '<i class="bi bi-send"></i> Enviar Notificación',
                    ['class' => 'btn btn-primary']
                ) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

