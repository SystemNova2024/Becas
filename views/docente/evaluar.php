<?php
use yii\helpers\Html;

/** @var $solicitud app\models\SolicitudBeca */
?>

<h1><i class="bi bi-check2-circle"></i> Evaluar Solicitud</h1>

<p><strong>ID:</strong> <?= Html::encode($solicitud->id) ?></p>
<p><strong>Estudiante:</strong> <?= Html::encode($solicitud->estudiante_nombre) ?></p>
<p><strong>Tipo de Beca:</strong> <?= Html::encode($solicitud->tipo_beca) ?></p>

<?= Html::beginForm(['docente/evaluar', 'id' => $solicitud->id], 'post') ?>
  <div class="mb-3">
    <label for="observaciones" class="form-label">Observaciones:</label>
    <textarea name="observaciones" id="observaciones" class="form-control" rows="4"></textarea>
  </div>
  <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Guardar Evaluación</button>
<?= Html::endForm() ?>

<?= Html::a('Volver', ['docente/evaluaciones'], ['class' => 'btn btn-secondary mt-2']) ?>
