<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $solicitudes app\models\SolicitudBeca[] */

$this->title = 'Mis Solicitudes de Beca - UTH';
?>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0 fw-semibold">📑 Mis Solicitudes de Beca</h3>
    <?= Html::a('➕ Nueva Solicitud', ['/site/becas'], ['class' => 'btn btn-success']) ?>
  </div>

  <?php if (!empty($solicitudes)): ?>
    <div class="table-responsive shadow-sm rounded mb-5">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-primary">
          <tr>
            <th scope="col" style="width: 5%;">#</th>
            <th scope="col" style="width: 25%;">Fecha</th>
            <th scope="col" style="width: 20%;">Estatus</th>
            <th scope="col" style="width: 30%;">Progreso</th>
            <th scope="col" class="text-end" style="width: 20%;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($solicitudes as $solicitud): 
            switch ($solicitud->estatus) {
              case 'Aprobada':
                $progress = 100;
                $progressClass = 'bg-success';
                break;
              case 'Rechazada':
                $progress = 100;
                $progressClass = 'bg-danger';
                break;
              case 'En Revisión':
              default:
                $progress = 50;
                $progressClass = 'bg-warning';
            }
          ?>
            <tr>
              <td class="fw-semibold"><?= Html::encode($solicitud->id) ?></td>
              <td><?= Yii::$app->formatter->asDate($solicitud->fecha_solicitud, 'long') ?></td>
              <td>
                <span class="badge <?= $progressClass ?> text-white px-3 py-2" style="font-size: 0.9rem;">
                  <?= Html::encode($solicitud->estatus) ?>
                </span>
              </td>
              <td>
                <div class="progress" style="height: 8px; border-radius: 4px; background-color: #e9ecef;">
                  <div class="progress-bar <?= $progressClass ?>" role="progressbar" style="width: <?= $progress ?>%;" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </td>
              <td class="text-end">
                <?= Html::a('📄 Ver Detalle', ['#'], [
                      'class' => 'btn btn-sm btn-outline-primary disabled',
                      'title' => 'Próximamente'
                    ]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info shadow-sm rounded mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center py-4">
        <div style="font-size: 2rem;">🗂️</div>
        <p class="mb-3 fs-6 text-center">Aún no tienes solicitudes registradas.</p>
        <?= Html::a('Realizar mi primera solicitud', ['/site/becas'], ['class' => 'btn btn-primary px-4']) ?>
      </div>
    </div>
  <?php endif; ?>
