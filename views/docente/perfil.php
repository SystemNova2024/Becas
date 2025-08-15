<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="profile-container">
    <div class="profile-header text-center mb-4">
        <div class="profile-avatar">
            <i class="bi bi-person-circle"></i>
        </div>
        <h1 class="display-5 fw-bold text-primary mb-2">
            Mi Perfil Docente
        </h1>
        <p class="lead text-muted">Universidad Tecnológica de Huejotzingo</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="profile-card">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        Información Personal
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="profile-info">
                        <div class="info-row">
                            <div class="info-label">
                                <i class="bi bi-person-badge text-primary"></i>
                                Nombre Completo
                            </div>
                            <div class="info-value">
                                <?= Html::encode(Yii::$app->user->identity->nombre_completo) ?>
                            </div>
                        </div>
                        
                        <div class="info-row">
                            <div class="info-label">
                                <i class="bi bi-envelope text-primary"></i>
                                Correo Electrónico
                            </div>
                            <div class="info-value">
                                <?= Html::encode(Yii::$app->user->identity->correo) ?>
                            </div>
                        </div>
                        
                        <div class="info-row">
                            <div class="info-label">
                                <i class="bi bi-shield-check text-primary"></i>
                                Rol del Sistema
                            </div>
                            <div class="info-value">
                                <span class="badge bg-success">Docente Evaluador</span>
                            </div>
                        </div>
                        
                        <div class="info-row">
                            <div class="info-label">
                                <i class="bi bi-calendar-check text-primary"></i>
                                Fecha de Registro
                            </div>
                            <div class="info-value">
                                <?= date('d/m/Y H:i', strtotime(Yii::$app->user->identity->creado_en)) ?>
                            </div>
                        </div>
                        
                        <div class="info-row">
                            <div class="info-label">
                                <i class="bi bi-clock-history text-primary"></i>
                                Última Actualización
                            </div>
                            <div class="info-value">
                                <?= date('d/m/Y H:i', strtotime(Yii::$app->user->identity->actualizado_en)) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="profile-stats">
                <div class="stats-card bg-primary text-white mb-3">
                    <div class="stats-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="stats-content">
                        <h4 class="stats-number">2024-2025</h4>
                        <p class="stats-label">Ciclo Escolar</p>
                    </div>
                </div>
                
                <div class="stats-card bg-success text-white mb-3">
                    <div class="stats-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stats-content">
                        <h4 class="stats-number">4</h4>
                        <p class="stats-label">Estudiantes Asignados</p>
  </div>
</div>
                
                <div class="stats-card bg-info text-white">
                    <div class="stats-icon">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="stats-content">
                        <h4 class="stats-number">UTH</h4>
                        <p class="stats-label">Institución</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="profile-actions">
                <h5 class="text-primary mb-3">
                    <i class="bi bi-gear me-2"></i>Acciones del Perfil
                </h5>
                <div class="actions-grid">
                    <button class="action-btn btn btn-outline-primary">
                        <i class="bi bi-pencil-square"></i>
                        <span>Editar Perfil</span>
                    </button>
                    
                    <button class="action-btn btn btn-outline-secondary">
                        <i class="bi bi-key"></i>
                        <span>Cambiar Contraseña</span>
                    </button>
                    
                    <button class="action-btn btn btn-outline-info">
                        <i class="bi bi-bell"></i>
                        <span>Notificaciones</span>
                    </button>
                    
                    <button class="action-btn btn btn-outline-warning">
                        <i class="bi bi-download"></i>
                        <span>Descargar CV</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-container {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.profile-header {
    border-bottom: 3px solid #667eea;
    padding-bottom: 1rem;
    margin-bottom: 2rem;
}

.profile-avatar {
    font-size: 5rem;
    color: #667eea;
    margin-bottom: 1rem;
}

.profile-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    overflow: hidden;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.profile-info {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.info-row {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.info-row:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.info-label {
    display: flex;
    align-items: center;
    font-weight: 600;
    color: #495057;
    min-width: 200px;
    margin-right: 1rem;
}

.info-label i {
    margin-right: 0.75rem;
    font-size: 1.2rem;
}

.info-value {
    color: #6c757d;
    font-weight: 500;
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
    font-size: 2.5rem;
    margin-right: 1rem;
    opacity: 0.8;
}

.stats-number {
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0;
    line-height: 1;
}

.stats-label {
    margin: 0;
    opacity: 0.9;
    font-size: 0.9rem;
}

.profile-actions {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 2rem;
    border: 1px solid #e9ecef;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1.5rem 1rem;
    border-radius: 10px;
    transition: all 0.3s ease;
    text-decoration: none;
    border: 2px solid;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.action-btn i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.action-btn span {
    font-weight: 500;
    text-align: center;
}

@media (max-width: 768px) {
    .info-row {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .info-label {
        min-width: auto;
        margin-bottom: 0.5rem;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
}
</style>
