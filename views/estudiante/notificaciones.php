<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Mis Notificaciones';
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-bell me-2"></i>
                        Notificaciones del Sistema
                    </h4>
                </div>
                <div class="card-body">
                    <?php if (empty($notificaciones)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No tienes notificaciones</h5>
                            <p class="text-muted">Cuando el departamento de servicios escolares te envíe un mensaje, aparecerá aquí.</p>
                        </div>
                    <?php else: ?>
                        <div class="notifications-list">
                            <?php foreach ($notificaciones as $notificacion): ?>
                                <div class="notification-item border-bottom p-3 <?= $notificacion->leida ? 'bg-light' : 'bg-white' ?>" 
                                     data-id="<?= $notificacion->id ?>">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center mb-2">
                                                <?php if (!$notificacion->leida): ?>
                                                    <span class="badge bg-primary me-2">Nueva</span>
                                                <?php endif; ?>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    <?= Yii::$app->formatter->asDatetime($notificacion->fecha_creacion, 'php:d/m/Y H:i') ?>
                                                </small>
                                            </div>
                                            
                                            <div class="notification-content">
                                                <p class="mb-2"><?= Html::encode($notificacion->mensaje) ?></p>
                                                
                                                <?php if ($notificacion->solicitud): ?>
                                                    <div class="notification-context">
                                                        <small class="text-muted">
                                                            <i class="fas fa-file-alt me-1"></i>
                                                            Solicitud #<?= Html::encode($notificacion->solicitud_id) ?>
                                                        </small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="notification-actions">
                                            <?php if (!$notificacion->leida): ?>
                                                <button class="btn btn-sm btn-outline-primary" 
                                                        onclick="marcarLeida(<?= $notificacion->id ?>)">
                                                    <i class="fas fa-check"></i> Marcar como leída
                                                </button>
                                            <?php else: ?>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check"></i> Leída
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="mt-3 text-center">
                            <button class="btn btn-outline-secondary" onclick="marcarTodasLeidas()">
                                <i class="fas fa-check-double me-1"></i>
                                Marcar todas como leídas
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function marcarLeida(id) {
    fetch('<?= Url::to(['estudiante/marcar-leida']) ?>?id=' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar la UI
            const notificationItem = document.querySelector(`[data-id="${id}"]`);
            if (notificationItem) {
                notificationItem.classList.remove('bg-white');
                notificationItem.classList.add('bg-light');
                
                const badge = notificationItem.querySelector('.badge.bg-primary');
                if (badge) {
                    badge.remove();
                }
                
                const button = notificationItem.querySelector('.btn');
                if (button) {
                    button.outerHTML = '<span class="badge bg-success"><i class="fas fa-check"></i> Leída</span>';
                }
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al marcar como leída');
    });
}

function marcarTodasLeidas() {
    const unreadNotifications = document.querySelectorAll('.notification-item:not(.bg-light)');
    const promises = [];
    
    unreadNotifications.forEach(item => {
        const id = item.getAttribute('data-id');
        promises.push(
            fetch('<?= Url::to(['estudiante/marcar-leida']) ?>?id=' + id, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
        );
    });
    
    Promise.all(promises)
    .then(() => {
        // Recargar la página para mostrar el estado actualizado
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al marcar todas como leídas');
    });
}
</script>

<style>
.notification-item {
    transition: background-color 0.3s ease;
}

.notification-item:hover {
    background-color: #f8f9fa !important;
}

.notification-content {
    line-height: 1.5;
}

.notification-context {
    margin-top: 0.5rem;
    padding-top: 0.5rem;
    border-top: 1px solid #e9ecef;
}
</style>


