<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="students-container">
    <div class="students-header text-center mb-4">
        <div class="uth-logo mb-4">
            <img src="<?= Yii::getAlias('@web') ?>/uploads/imagenes/logo.png" alt="UTH Logo" class="img-fluid" style="max-height: 130px;">
        </div>
        <h1 class="display-4 fw-bold text-dark">
            Mis Estudiantes
        </h1>
        <p class="lead text-muted">Universidad Tecnológica de Huejotzingo</p>
        <div class="header-divider"></div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="stats-card bg-light text-dark border">
                <div class="stats-icon">
                    <i class="bi bi-person-check-fill"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number"><?= count($estudiantes) ?></h3>
                    <p class="stats-label">Total Estudiantes</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stats-card bg-light text-dark border">
                <div class="stats-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number"><?= count($estudiantes) ?></h3>
                    <p class="stats-label">Estudiantes Activos</p>
                </div>
            </div>
        </div>
    </div>

    <div class="students-grid">
        <?php if (empty($estudiantes)): ?>
            <div class="no-students">
                <div class="no-students-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h4>No hay estudiantes asignados</h4>
                <p class="text-muted">Aún no tienes estudiantes asignados para evaluar.</p>
            </div>
        <?php else: ?>
            <?php foreach ($estudiantes as $estudiante): ?>
                <div class="student-card">
                    <div class="student-header">
                        <div class="student-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="student-status-badge">
                            <i class="bi bi-check-circle-fill"></i> Activo
                        </div>
                    </div>
                    <div class="student-body">
                        <h5 class="student-name"><?= Html::encode($estudiante->nombre_completo) ?></h5>
                        <p class="student-email">
                            <i class="bi bi-envelope me-2"></i>
                            <?= Html::encode($estudiante->correo) ?>
                        </p>
                        <div class="student-info">
                            <span class="info-item">
                                <i class="bi bi-person-badge me-1"></i>
                                ID: <?= $estudiante->id ?>
                            </span>
                            <span class="info-item">
                                <i class="bi bi-calendar me-1"></i>
                                Registro: <?= date('d/m/Y', strtotime($estudiante->creado_en)) ?>
                            </span>
                        </div>
                    </div>
                    <div class="student-actions">
                        <button class="btn btn-outline-dark btn-sm" onclick="verPerfil(<?= $estudiante->id ?>, '<?= Html::encode($estudiante->nombre_completo) ?>')">
                            <i class="bi bi-eye"></i> Ver Perfil
                        </button>
                        <button class="btn btn-outline-dark btn-sm" onclick="enviarMensaje(<?= $estudiante->id ?>, '<?= Html::encode($estudiante->nombre_completo) ?>')">
                            <i class="bi bi-chat-dots"></i> Mensaje
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Modal para ver perfil del estudiante -->
<div class="modal fade" id="perfilModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-person-badge me-2"></i>Perfil del Estudiante
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="perfilModalBody">
                <!-- Contenido del perfil se cargará aquí -->
            </div>
        </div>
    </div>
</div>

<!-- Modal para enviar mensaje -->
<div class="modal fade" id="mensajeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="bi bi-chat-dots me-2"></i>Enviar Mensaje
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="mensajeForm">
                    <div class="mb-3">
                        <label class="form-label">Para:</label>
                        <input type="text" class="form-control" id="destinatarioMensaje" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Asunto:</label>
                        <input type="text" class="form-control" id="asuntoMensaje" placeholder="Asunto del mensaje">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensaje:</label>
                        <textarea class="form-control" id="contenidoMensaje" rows="4" placeholder="Escribe tu mensaje aquí..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="enviarMensajeConfirmado()">
                    <i class="bi bi-send"></i> Enviar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function verPerfil(estudianteId, nombreEstudiante) {
    // Simular carga de datos del perfil
    const perfilContent = `
        <div class="text-center mb-4">
            <div class="student-avatar-large mb-3">
                <i class="bi bi-person-circle"></i>
            </div>
            <h4>${nombreEstudiante}</h4>
            <span class="badge bg-success">Estudiante Activo</span>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-primary"><i class="bi bi-info-circle me-2"></i>Información Personal</h6>
                <ul class="list-unstyled">
                    <li><strong>ID:</strong> ${estudianteId}</li>
                    <li><strong>Estado:</strong> Activo</li>
                    <li><strong>Programa:</strong> TSU en Tecnologías de la Información</li>
                    <li><strong>Cuatrimestre:</strong> 4to</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h6 class="text-primary"><i class="bi bi-graph-up me-2"></i>Rendimiento Académico</h6>
                <ul class="list-unstyled">
                    <li><strong>Promedio:</strong> 8.5</li>
                    <li><strong>Asignaturas:</strong> 6</li>
                    <li><strong>Créditos:</strong> 180</li>
                    <li><strong>Estado:</strong> Regular</li>
                </ul>
            </div>
        </div>
        
        <div class="mt-4">
            <h6 class="text-primary"><i class="bi bi-calendar-check me-2"></i>Historial Reciente</h6>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Actividad</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${new Date().toLocaleDateString()}</td>
                            <td>Evaluación Parcial</td>
                            <td><span class="badge bg-warning">Pendiente</span></td>
                        </tr>
                        <tr>
                            <td>${new Date(Date.now() - 7*24*60*60*1000).toLocaleDateString()}</td>
                            <td>Proyecto Final</td>
                            <td><span class="badge bg-success">Completado</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    `;
    
    document.getElementById('perfilModalBody').innerHTML = perfilContent;
    new bootstrap.Modal(document.getElementById('perfilModal')).show();
}



function enviarMensaje(estudianteId, nombreEstudiante) {
    document.getElementById('destinatarioMensaje').value = nombreEstudiante;
    document.getElementById('asuntoMensaje').value = '';
    document.getElementById('contenidoMensaje').value = '';
    new bootstrap.Modal(document.getElementById('mensajeModal')).show();
}

function enviarMensajeConfirmado() {
    const asunto = document.getElementById('asuntoMensaje').value;
    const contenido = document.getElementById('contenidoMensaje').value;
    
    if (!asunto || !contenido) {
        alert('Por favor completa todos los campos');
        return;
    }
    
    // Aquí implementarías el envío real del mensaje
    alert('✅ Mensaje enviado correctamente al estudiante');
    
    // Cerrar modal
    bootstrap.Modal.getInstance(document.getElementById('mensajeModal')).hide();
}
</script>

<style>
.students-container {
    background: #ffffff;
    border-radius: 15px;
    padding: 3rem;
    border: 2px solid #e9ecef;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.students-header {
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 2rem;
    margin-bottom: 3rem;
}

.uth-logo {
    text-align: center;
}

.header-divider {
    width: 120px;
    height: 3px;
    background: #495057;
    margin: 1.5rem auto 0;
}

.stats-card {
    border-radius: 15px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
}

.stats-icon {
    font-size: 3rem;
    margin-right: 1rem;
    opacity: 0.8;
}

.stats-number {
    font-size: 2.5rem;
    font-weight: bold;
    margin: 0;
    line-height: 1;
}

.stats-label {
    margin: 0;
    opacity: 0.9;
    font-size: 1rem;
}

.students-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.student-card {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.student-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.15);
    border-color: #28a745;
}

.student-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.student-avatar {
    font-size: 3rem;
    color: #6c757d;
}

.student-status-badge {
    background: #f8f9fa;
    color: #495057;
    border: 1px solid #dee2e6;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
}

.student-name {
    color: #495057;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.student-email {
    color: #6c757d;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.student-info {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.info-item {
    font-size: 0.875rem;
    color: #6c757d;
}

.student-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    border-radius: 8px;
}

.student-avatar-large {
    font-size: 5rem;
    color: #6c757d;
}

.no-students {
    text-align: center;
    padding: 3rem;
    grid-column: 1 / -1;
}

.no-students-icon {
    font-size: 4rem;
    color: #6c757d;
    margin-bottom: 1rem;
}

.no-students h4 {
    color: #495057;
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .students-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-card {
        margin-bottom: 1rem;
    }
    
    .student-actions {
        flex-direction: column;
    }
    
    .btn-sm {
        width: 100%;
    }
}
</style>
