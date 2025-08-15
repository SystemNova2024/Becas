<?php
use yii\helpers\Html;

/** @var $solicitud app\models\SolicitudBeca */
?>

<h1><i class="bi bi-eye"></i> Ver Solicitud</h1>

<p><strong>ID:</strong> <?= Html::encode($solicitud->id) ?></p>
<p><strong>Estudiante:</strong> <?= Html::encode($solicitud->estudiante_nombre) ?></p>
<p><strong>Tipo de Beca:</strong> <?= Html::encode($solicitud->tipo_beca) ?></p>
<p><strong>Fecha:</strong> <?= Html::encode($solicitud->fecha_solicitud) ?></p>
<p><strong>Estatus:</strong> <?= Html::encode($solicitud->estatus) ?></p>

<?= Html::a('Volver', ['docente/evaluaciones'], ['class' => 'btn btn-secondary']) ?>
