<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="dashboard-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold text-dark mb-2">
                Panel Docente Evaluador
            </h1>
            <p class="lead text-muted mb-0">
                Bienvenido, <strong class="text-dark"><?= Html::encode(Yii::$app->user->identity->nombre_completo) ?></strong>
            </p>
            <p class="text-muted">Universidad Tecnológica de Huejotzingo</p>
        </div>
        <div class="col-md-4 text-end">
            <div class="uth-logo-dashboard">
                <img src="<?= Yii::getAlias('@web') ?>/uploads/imagenes/logo.png" alt="UTH Logo" class="img-fluid" style="max-height: 120px;">
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Calendario Escolar -->
    <div class="col-lg-6">
        <div class="card shadow-lg border-0 h-100">
                            <div class="card-header bg-light text-dark border-bottom">
                    <h5 class="mb-0">
                        Calendario Escolar 2024-2025
                    </h5>
                </div>
            <div class="card-body p-4">
                <div class="calendar-preview">
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <div class="month-card active">
                                <div class="month-name">Sept</div>
                                <div class="month-year">2024</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="month-card">
                                <div class="month-name">Oct</div>
                                <div class="month-year">2024</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="month-card">
                                <div class="month-name">Nov</div>
                                <div class="month-year">2024</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="month-card">
                                <div class="month-name">Dic</div>
                                <div class="month-year">2024</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <?= Html::a('Ver Calendario Completo', ['docente/calendario'], ['class' => 'btn btn-outline-dark btn-lg']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Estudiantes -->
    <div class="col-lg-6">
        <div class="card shadow-lg border-0 h-100">
            <div class="card-header bg-light text-dark border-bottom">
                <h5 class="mb-0">
                    Mis Estudiantes
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="students-preview">
                    <div class="student-count mb-3">
                        <div class="count-circle">
                            <span class="count-number">4</span>
                        </div>
                        <p class="text-center text-muted mb-0">Estudiantes Asignados</p>
                    </div>
                    <div class="text-center mt-4">
                        <?= Html::a('Ver Todos los Estudiantes', ['docente/estudiantes'], ['class' => 'btn btn-outline-dark btn-lg']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-4">
    <!-- Evaluaciones -->
    <div class="col-lg-4">
        <div class="card shadow-lg border-0 h-100">
            <div class="card-header bg-light text-dark border-bottom">
                <h5 class="mb-0">
                    Evaluaciones
                </h5>
            </div>
            <div class="card-body p-4 text-center">
                <div class="feature-icon mb-3">
                    <i class="bi bi-clipboard-check"></i>
                </div>
                <h6>Gestionar Solicitudes</h6>
                <p class="text-muted">Revisa y evalúa las solicitudes de becas pendientes</p>
                <?= Html::a('Ir a Evaluaciones', ['docente/evaluaciones'], ['class' => 'btn btn-outline-dark btn-lg']) ?>
            </div>
        </div>
    </div>

    <!-- Subir Calificaciones -->
    <div class="col-lg-4">
        <div class="card shadow-lg border-0 h-100">
            <div class="card-header bg-light text-dark border-bottom">
                <h5 class="mb-0">
                    Subir Calificaciones
                </h5>
            </div>
            <div class="card-body p-4 text-center">
                <div class="feature-icon mb-3">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <h6>Cargar Archivos</h6>
                <p class="text-muted">Sube calificaciones y documentos de evaluación</p>
                <?= Html::a('Subir Archivos', ['docente/subir-calificacion'], ['class' => 'btn btn-outline-dark btn-lg']) ?>
      </div>
    </div>
  </div>

    <!-- Perfil -->
    <div class="col-lg-4">
        <div class="card shadow-lg border-0 h-100">
            <div class="card-header bg-light text-dark border-bottom">
                <h5 class="mb-0">
                    Mi Perfil
                </h5>
            </div>
            <div class="card-body p-4 text-center">
                <div class="feature-icon mb-3">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h6>Información Personal</h6>
                <p class="text-muted">Consulta y actualiza tu información personal</p>
                <?= Html::a('Ver Perfil', ['docente/perfil'], ['class' => 'btn btn-outline-dark btn-lg']) ?>
      </div>
    </div>
  </div>
</div>

<style>
.dashboard-header {
    background: #ffffff;
    color: #495057;
    padding: 3rem;
    border-radius: 15px;
    margin-bottom: 3rem;
    border: 2px solid #e9ecef;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.uth-logo-dashboard {
    text-align: center;
}



.card {
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}



.month-card {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1rem 0.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.month-card:hover {
    background: #e9ecef;
    transform: scale(1.05);
}

.month-card.active {
    background: #495057;
    color: white;
}

.month-name {
    font-weight: bold;
    font-size: 1.1rem;
}

.month-year {
    font-size: 0.9rem;
    opacity: 0.8;
}

.count-circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: #f8f9fa;
    border: 3px solid #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.count-number {
    font-size: 3rem;
    font-weight: bold;
    color: #495057;
}

.feature-icon {
    font-size: 4rem;
    color: #6c757d;
    opacity: 0.7;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
    border-radius: 10px;
}
</style>
