<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\SolicitudBeca $solicitud */
/** @var app\models\Notificacion $model */

$this->title = 'Enviar Notificación al Estudiante';
?>

<div class="container mt-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-warning text-dark">
            <h3 class="mb-0">
                <i class="bi bi-bell me-2"></i> Enviar Notificación
            </h3>
        </div>
        <div class="card-body p-4">
            <div class="alert alert-info">
                <strong>Solicitud:</strong> #<?= $solicitud->id ?><br>
                <strong>Estudiante ID:</strong> <?= $solicitud->estudiante_id ?>
            </div>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'mensaje')->textarea([
                'rows' => 6,
                'class' => 'form-control',
                'placeholder' => 'Escribe el mensaje que se enviará al estudiante...'
            ])->label('Mensaje para el Estudiante') ?>

            <div class="d-flex justify-content-end mt-4 gap-2">
                <?= Html::a('Cancelar', ['coordinador/solicitudes'], [
                    'class' => 'btn btn-outline-secondary'
                ]) ?>
                <?= Html::submitButton(
                    '<i class="bi bi-send"></i> Enviar Notificación',
                    ['class' => 'btn btn-warning']
                ) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

