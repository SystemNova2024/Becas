<?php
use yii\helpers\Html;

/** @var app\models\SolicitudBeca $solicitud */

$this->title = 'Ver Solicitud #' . $solicitud->id;
?>

<div class="container mt-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="bi bi-eye me-2"></i> Solicitud #<?= $solicitud->id ?>
            </h3>
        </div>
        <div class="card-body p-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>📋 Información del Estudiante</h5>
                    <p><strong>Estudiante ID:</strong> <?= $solicitud->estudiante_id ?></p>
                </div>
                <div class="col-md-6">
                    <h5>🎓 Información de la Beca</h5>
                    <p><strong>Beca ID:</strong> <?= $solicitud->beca_id ?></p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>📅 Fechas</h5>
                    <p><strong>Fecha de Solicitud:</strong> <?= $solicitud->fecha_solicitud ?></p>
                </div>
                <div class="col-md-6">
                    <h5>📊 Estatus</h5>
                    <?php
                    $color = match($solicitud->estatus) {
                        'aprobada' => 'success',
                        'rechazada' => 'danger',
                        'en_revision' => 'warning',
                        default => 'info',
                    };
                    $estatus = ucfirst(str_replace('_', ' ', $solicitud->estatus));
                    ?>
                    <span class="badge bg-<?= $color ?> p-2"><?= $estatus ?></span>
                </div>
            </div>

            <?php if ($solicitud->observaciones): ?>
                <div class="alert alert-info">
                    <h6>💬 Observaciones</h6>
                    <p><?= Html::encode($solicitud->observaciones) ?></p>
                </div>
            <?php endif; ?>

            <?php if ($solicitud->justificacion): ?>
                <div class="alert alert-secondary">
                    <h6>📝 Justificación del Estudiante</h6>
                    <p><?= Html::encode($solicitud->justificacion) ?></p>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between mt-4">
                <?= Html::a(
                    '<i class="bi bi-arrow-left"></i> Volver a Solicitudes',
                    ['coordinador/solicitudes'],
                    ['class' => 'btn btn-outline-secondary']
                ) ?>
                
                <div>
                    <?= Html::a(
                        '<i class="bi bi-bell"></i> Enviar Notificación',
                        ['coordinador/enviar-notificacion', 'id' => $solicitud->id],
                        ['class' => 'btn btn-warning me-2']
                    ) ?>
                    
                    <?php if ($solicitud->estatus === 'pendiente'): ?>
                        <?= Html::a(
                            '<i class="bi bi-check-circle"></i> Aprobar',
                            ['coordinador/aprobar', 'id' => $solicitud->id],
                            ['class' => 'btn btn-success me-2', 'data-confirm' => '¿Aprobar esta solicitud?']
                        ) ?>
                        <?= Html::a(
                            '<i class="bi bi-x-circle"></i> Rechazar',
                            ['coordinador/rechazar', 'id' => $solicitud->id],
                            ['class' => 'btn btn-danger', 'data-confirm' => '¿Rechazar esta solicitud?']
                        ) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

