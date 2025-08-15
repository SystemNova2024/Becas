<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h1 class="mb-4">
  <i class="bi bi-pencil-square text-primary"></i> Evaluar Solicitudes
</h1>

<div class="mb-3 p-3 bg-light border-start border-4 border-primary rounded shadow-sm">
  <p class="mb-0">
    Aquí puedes ver todas las <strong>solicitudes asignadas</strong> para evaluar, agregar observaciones y dar seguimiento académico.
  </p>
</div>

<div class="table-responsive shadow-sm border rounded bg-white">
  <table class="table table-hover mb-0">
    <thead class="table-primary">
      <tr>
        <th scope="col">#</th>
        <th>Estudiante</th>
        <th>Tipo de Beca</th>
        <th>Fecha</th>
        <th>Estatus</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- 🔗 Ejemplo: solicitudes de muestra -->
      <tr>
        <th scope="row">1</th>
        <td>Fernanda Alonso</td>
        <td>Beca Académica</td>
        <td>2024-07-25</td>
        <td><span class="badge bg-warning text-dark">Pendiente</span></td>
        <td>
          <?= Html::a('<i class="bi bi-eye"></i> Ver', Url::to(['docente/ver-solicitud', 'id' => 1]), ['class' => 'btn btn-outline-primary btn-sm']) ?>
          <?= Html::a('<i class="bi bi-check2-circle"></i> Evaluar', Url::to(['docente/evaluar', 'id' => 1]), ['class' => 'btn btn-outline-success btn-sm']) ?>
        </td>
      </tr>
      <!-- Puedes duplicar estos TR de ejemplo -->
      <tr>
        <th scope="row">2</th>
        <td>José Pérez</td>
        <td>Beca Deportiva</td>
        <td>2024-07-23</td>
        <td><span class="badge bg-success">Aprobada</span></td>
        <td>
          <?= Html::a('<i class="bi bi-eye"></i> Ver', Url::to(['docente/ver-solicitud', 'id' => 2]), ['class' => 'btn btn-outline-primary btn-sm']) ?>
        </td>
      </tr>
      <!-- Si no hay registros, se muestra mensaje -->
    </tbody>
  </table>
</div>

<div class="mt-3 alert alert-info shadow-sm">
  <i class="bi bi-info-circle"></i> 🚧 Este módulo es funcional y listo para conectar con tu base de datos real.
</div>
