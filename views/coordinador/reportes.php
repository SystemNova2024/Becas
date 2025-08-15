<?php
use yii\helpers\Html;
?>

<h2 class="mb-4"><i class="bi bi-bar-chart-line"></i> Reportes y Estadísticas</h2>

<div class="row g-4">
  <div class="col-md-4">
    <div class="card shadow-sm border-0 text-center">
      <div class="card-body">
        <h1 class="text-success"><i class="bi bi-graph-up-arrow"></i></h1>
        <h6 class="fw-bold">Becas Otorgadas</h6>
        <p class="text-muted">120 becas entregadas este semestre.</p>
        <a href="#" class="btn btn-outline-success btn-sm">Ver Reporte</a>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow-sm border-0 text-center">
      <div class="card-body">
        <h1 class="text-primary"><i class="bi bi-pie-chart-fill"></i></h1>
        <h6 class="fw-bold">Distribución</h6>
        <p class="text-muted">Comparativa por tipo de beca.</p>
        <a href="#" class="btn btn-outline-primary btn-sm">Generar Gráfica</a>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow-sm border-0 text-center">
      <div class="card-body">
        <h1 class="text-warning"><i class="bi bi-file-earmark-pdf"></i></h1>
        <h6 class="fw-bold">Exportar</h6>
        <p class="text-muted">Descargar reportes en PDF.</p>
        <a href="#" class="btn btn-outline-warning btn-sm">Exportar PDF</a>
      </div>
    </div>
  </div>
</div>
