<?php
use yii\helpers\Html;
?>

<div class="text-center mb-5">
    <h1 class="fw-bold"><i class="bi bi-speedometer2"></i> Panel del Coordinador</h1>
    <p class="text-muted fs-6 mt-2">Supervisa solicitudes, becas y soporte fácilmente desde tu panel.</p>
</div>

<div class="row g-4 mt-4 justify-content-center">
    <!-- Solicitudes -->
    <div class="col-md-6 col-lg-3 d-flex justify-content-center">
        <a href="<?= Yii::$app->urlManager->createUrl(['coordinador/solicitudes']) ?>" class="text-decoration-none w-100" style="max-width: 320px;">
            <div class="card shadow-sm border-0 rounded-4 hover-card text-center p-4">
                <div class="icon-container mb-3">
                    <i class="bi bi-folder-check-fill text-primary fs-1"></i>
                </div>
                <h5 class="fw-bold mb-2">Solicitudes</h5>
                <p class="text-muted mb-3">Verifica y gestiona las solicitudes de becas.</p>
                <span class="btn btn-outline-primary btn-sm rounded-pill px-4">Ir a Solicitudes</span>
            </div>
        </a>
    </div>


    <!-- Gestión de Becas -->
    <div class="col-md-6 col-lg-4 d-flex justify-content-center">
        <a href="<?= Yii::$app->urlManager->createUrl(['coordinador/becas']) ?>" class="text-decoration-none w-100" style="max-width: 320px;">
            <div class="card shadow-sm border-0 rounded-4 hover-card text-center p-4">
                <div class="icon-container mb-3">
                    <i class="bi bi-award-fill text-success fs-1"></i>
                </div>
                <h5 class="fw-bold mb-2">Gestión de Becas</h5>
                <p class="text-muted mb-3">Crea, edita y administra las becas disponibles para los estudiantes.</p>
                <span class="btn btn-outline-success btn-sm rounded-pill px-4">Gestionar Becas</span>
            </div>
        </a>
    </div>
</div>

<style>
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    background: #ffffff;
}

.hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.1);
}

.icon-container i {
    transition: transform 0.3s ease;
}

.hover-card:hover .icon-container i {
    transform: scale(1.2);
}

.card p {
    font-size: 0.9rem;
}
</style>
