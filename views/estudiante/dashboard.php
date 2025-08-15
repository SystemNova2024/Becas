<?php
use yii\helpers\Html;

$user = Yii::$app->user->identity;
$fotoPerfil = $user->foto_perfil ?? null;
$fotoSrc = Yii::getAlias('@web/uploads/imagenes/fer.jpeg');
?>

<div class="container py-5">
  <div class="row gy-5">

    <!-- Contenido principal -->
    <div class="col-lg-8">

      <!-- Última solicitud -->
      <div class="card rounded-4 shadow-sm border-0 mb-5">
        <div class="card-body p-5">
          <?php if ($ultimaSolicitud): ?>
            <div class="p-4 rounded-4 border mb-4" style="background: #fefefe; box-shadow: 0 2px 12px rgba(0,0,0,0.05);">
              <h5 class="mb-3 fw-bold text-primary d-flex align-items-center gap-2">
                <span style="font-size:1.3rem;">📄</span> Última Solicitud
              </h5>

              <p class="mb-2"><strong>Fecha:</strong> <?= Html::encode($ultimaSolicitud->fecha_solicitud) ?></p>

              <p class="mb-3 d-flex align-items-center gap-2">
                <strong>Estatus:</strong>
                <span class="px-3 py-1 rounded-pill text-white fw-semibold"
                      style="background-color: <?= $ultimaSolicitud->estatus === 'Aprobada' ? '#4caf50' : ($ultimaSolicitud->estatus === 'Rechazada' ? '#e53935' : '#fbc02d') ?>;">
                  <?= Html::encode($ultimaSolicitud->estatus) ?>
                </span>
              </p>

              <?php if ($ultimaSolicitud->justificacion): ?>
                <p class="text-secondary mb-3"><strong>Justificación:</strong><br><?= Html::encode($ultimaSolicitud->justificacion) ?></p>
              <?php endif; ?>

              <?php if ($ultimaSolicitud->observaciones): ?>
                <p class="text-secondary mb-3"><strong>Comentarios Coordinador:</strong><br><?= Html::encode($ultimaSolicitud->observaciones) ?></p>
              <?php endif; ?>

              <div class="d-flex justify-content-center mt-3">
                <?= Html::a('Ver Mis Solicitudes', ['estudiante/solicitudes'], ['class' => 'btn btn-outline-primary px-4 rounded-pill']) ?>
              </div>
            </div>
          <?php else: ?>
            <div class="text-center p-4 rounded-4 border mb-4" style="background: #fefefe; box-shadow: 0 2px 12px rgba(0,0,0,0.05);">
              <p class="mb-3 fw-semibold">Aún no has solicitado ninguna beca. ¡Comienza ahora!</p>
              <?= Html::a('Solicitar mi Primera Beca', ['estudiante/becas'], ['class' => 'btn btn-primary px-5 rounded-pill']) ?>
            </div>
          <?php endif; ?>

          <div class="d-flex justify-content-center mt-4">
            <?= Html::a('Solicitar Nueva Beca', ['estudiante/becas'], ['class' => 'btn btn-primary px-5 py-2 rounded-pill']) ?>
          </div>
        </div>
      </div>

      <!-- Requisitos y fechas -->
      <div class="row g-4">
        <div class="col-md-6">
          <div class="card rounded-4 shadow-sm border-0 h-100">
            <div class="card-header bg-white text-primary fw-bold rounded-top px-4 py-3 d-flex align-items-center gap-2 border-bottom">
              <span style="font-size:1.25rem;">📌</span> Requisitos Generales
            </div>
            <div class="card-body text-secondary fs-6 px-4 py-3">
              <ul class="mb-0 ps-3">
                <li>Historial académico actualizado</li>
                <li>Constancia de ingresos familiares</li>
                <li>Fotografía reciente</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card rounded-4 shadow-sm border-0 h-100">
            <div class="card-header bg-white text-primary fw-bold rounded-top px-4 py-3 d-flex align-items-center gap-2 border-bottom">
              <span style="font-size:1.25rem;">📅</span> Fechas Importantes
            </div>
            <div class="card-body text-secondary fs-6 px-4 py-3">
              <p class="mb-2"><strong>Próxima convocatoria:</strong> Septiembre 2024</p>
              <p class="mb-0"><strong>Fecha límite:</strong> 15 de Octubre 2024</p>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Perfil usuario -->
    <div class="col-lg-4">
      <div class="card shadow-sm rounded-4 border-0 py-5 px-4 text-center">
        <img src="<?= Html::encode($fotoSrc) ?>"
             class="rounded-circle mb-4 mx-auto d-block border border-2"
             alt="Foto perfil de <?= Html::encode($user->nombre_completo) ?>"
             style="width: 140px; height: 140px; object-fit: cover; transition: box-shadow 0.3s ease;">
        <h5 class="fw-bold mb-2"><?= Html::encode($user->nombre_completo) ?></h5>
        <p class="text-muted mb-4 fst-italic">Estudiante</p>
        <?= Html::a('Editar Perfil', ['estudiante/perfil'], ['class' => 'btn btn-outline-primary px-4 rounded-pill']) ?>
      </div>
    </div>

  </div>
</div>

<style>
  .card.shadow-sm {
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
  }

  .card img.rounded-circle:hover {
    box-shadow: 0 4px 20px rgba(13,110,253,0.25);
  }

  .btn-outline-primary:hover {
    background-color: #0d6efd;
    color: white !important;
    box-shadow: 0 4px 12px rgba(13,110,253,0.35);
  }

  .btn-primary:hover {
    box-shadow: 0 4px 15px rgba(13,110,253,0.3);
  }

  ul li {
    margin-bottom: 0.5rem;
  }
</style>
