<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel Docente | UTH</title>
  <?php $this->head() ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: #f1f4f6;
      font-family: 'Inter', sans-serif;
    }
    .header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      padding: 15px 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .sidebar {
      height: 100vh;
      background: linear-gradient(180deg, #14532d 0%, #166534 100%);
      color: #fff;
      width: 250px;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    .sidebar a {
      color: #fff;
      display: block;
      padding: 15px 20px;
      text-decoration: none;
      border-left: 4px solid transparent;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background: rgba(255, 255, 255, 0.15);
      border-left: 4px solid #fff;
      transform: translateX(5px);
    }
    .sidebar a i {
      margin-right: 12px;
      width: 20px;
      text-align: center;
    }
    .content {
      margin-left: 250px;
      padding: 30px;
      min-height: calc(100vh - 80px);
    }
    footer {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      padding: 15px 0;
      text-align: center;
      margin-left: 250px;
    }
    .sidebar-header {
      text-align: center;
      padding: 2rem 1rem;
      border-bottom: 1px solid rgba(255,255,255,0.2);
      margin-bottom: 1rem;
    }
    .sidebar-header i {
      font-size: 3rem;
      margin-bottom: 0.5rem;
      display: block;
    }
    .sidebar-header h5 {
      margin: 0;
      font-size: 1.1rem;
      opacity: 0.9;
    }
  </style>
</head>
<body>
<?php $this->beginBody(); ?>

<!-- Header superior -->
<div class="header d-flex align-items-center justify-content-between">
  <div class="fw-bold fs-5">
    <i class="bi bi-mortarboard-fill me-2"></i>
    Panel Docente Evaluador - UTH
  </div>
  <div>
    <span class="small">
      <i class="bi bi-person-circle me-1"></i>
      <?= Html::encode(Yii::$app->user->identity->nombre_completo ?? '') ?>
    </span>
  </div>
</div>

<div class="d-flex">
  <!-- Sidebar -->
  <nav class="sidebar d-flex flex-column">
    <div class="sidebar-header">
      <i class="bi bi-mortarboard"></i>
      <h5>Docente</h5>
    </div>
    
    <?= Html::a('<i class="bi bi-house-door"></i> Dashboard', Url::to(['docente/dashboard']), [
      'class' => Yii::$app->controller->action->id === 'dashboard' ? 'active' : ''
    ]) ?>
    
    <?= Html::a('<i class="bi bi-calendar3"></i> Calendario', Url::to(['docente/calendario']), [
      'class' => Yii::$app->controller->action->id === 'calendario' ? 'active' : ''
    ]) ?>
    
    <?= Html::a('<i class="bi bi-people"></i> Estudiantes', Url::to(['docente/estudiantes']), [
      'class' => Yii::$app->controller->action->id === 'estudiantes' ? 'active' : ''
    ]) ?>
    
    <hr class="border border-light mx-3 my-3">
    
    <?= Html::a('<i class="bi bi-pencil-square"></i> Evaluaciones', Url::to(['docente/evaluaciones']), [
      'class' => Yii::$app->controller->action->id === 'evaluaciones' ? 'active' : ''
    ]) ?>
    
    <?= Html::a('<i class="bi bi-upload"></i> Subir Calificaciones', Url::to(['docente/subir-calificacion']), [
      'class' => Yii::$app->controller->action->id === 'subir-calificacion' ? 'active' : ''
    ]) ?>
    
    <hr class="border border-light mx-3 my-3">
    
    <?= Html::a('<i class="bi bi-person"></i> Mi Perfil', Url::to(['docente/perfil']), [
      'class' => Yii::$app->controller->action->id === 'perfil' ? 'active' : ''
    ]) ?>
    
    <hr class="border border-light mx-3 my-3">
    
    <?= Html::a('<i class="bi bi-box-arrow-right"></i> Cerrar Sesión', Url::to(['site/logout']), [
      'data-method' => 'post',
      'class' => 'text-warning'
    ]) ?>
  </nav>

  <!-- Contenido principal -->
  <main class="content flex-fill">
    <?= $content ?>
  </main>
</div>

<footer>
  <p class="mb-0">
    <i class="bi bi-heart-fill text-danger me-1"></i>
    © <?= date('Y') ?> Universidad Tecnológica de Huejotzingo | Panel Docente Evaluador
  </p>
</footer>

<?php $this->endBody(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $this->endPage(); ?>
