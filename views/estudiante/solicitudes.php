<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $solicitudes app\models\SolicitudBeca[] */

$this->title = 'Mis Solicitudes de Beca - UTH';
?>

<div class="container py-4">
  <!-- Mensajes de confirmación -->
  <?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>✓ ¡Éxito!</strong> <?= Yii::$app->session->getFlash('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  
  <?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>⚠️ Error:</strong> <?= Yii::$app->session->getFlash('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0 fw-semibold">📑 Mis Solicitudes de Beca</h3>
    <?= Html::a(
      '<i class="bi bi-bell"></i> Enviar Notificación',
      ['estudiante/contactar-coordinador'],
      ['class' => 'btn btn-outline-primary']
    ) ?>
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
            switch (strtolower($solicitud->estatus)) {
              case 'aprobada':
                $progress = 100;
                $progressClass = 'bg-success';
                $badgeClass = 'success';
                break;
              case 'rechazada':
                $progress = 100;
                $progressClass = 'bg-danger';
                $badgeClass = 'danger';
                break;
              case 'en revisión':
              case 'en_revision':
                $progress = 50;
                $progressClass = 'bg-warning';
                $badgeClass = 'warning';
                break;
              case 'pendiente':
              default:
                $progress = 25;
                $progressClass = 'bg-info';
                $badgeClass = 'info';
            }
          ?>
            <tr>
              <td class="fw-semibold"><?= Html::encode($solicitud->id) ?></td>
              <td><?= Yii::$app->formatter->asDate($solicitud->fecha_solicitud, 'long') ?></td>
              <td>
                <span class="badge bg-<?= $badgeClass ?> px-3 py-2" style="font-size: 0.9rem;">
                  <?= Html::encode(ucwords(str_replace('_', ' ', $solicitud->estatus))) ?>
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
    <div class="alert alert-info shadow-sm rounded mb-5 text-center py-5">
      <div style="font-size: 3rem;">📝</div>
      <h5 class="mt-3 mb-3">No tienes solicitudes registradas</h5>
      <p class="text-muted">Para solicitar una beca, visita la sección "Becas Disponibles" o "Becas Institucionales"</p>
    </div>
  <?php endif; ?>
