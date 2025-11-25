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
  <title>🎓 Coordinador | Portal UTH</title>
  <?php $this->head(); ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #fff;
      margin: 0;
    }
    .sidebar {
      height: 100vh;
      width: 220px;
      background: #f8f9fa;
      border-right: 1px solid #dee2e6;
      position: fixed;
      padding: 20px;
      overflow-y: auto;
    }
    .sidebar .logo-container {
      text-align: center;
      margin-bottom: 25px;
    }
    .sidebar .logo-container img {
      max-width: 120px;
      margin-bottom: 10px;
    }
    .sidebar h4 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 20px;
      color: #212529;
    }
    .sidebar a {
      display: flex;
      align-items: center;
      color: #495057;
      text-decoration: none;
      padding: 10px 15px;
      margin-bottom: 5px;
      border-radius: 6px;
      transition: 0.2s;
    }
    .sidebar a i {
      margin-right: 10px;
      font-size: 1.1rem;
    }
    .sidebar a:hover, .sidebar a.active {
      background: #e2e6ea;
      color: #0d6efd;
    }
    .content {
      margin-left: 220px;
      padding: 30px 40px;
      min-height: 100vh;
      background: #fff;
      display: flex;
      flex-direction: column;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #dee2e6;
    }
    .header h5 {
      margin: 0;
      font-weight: 600;
      color: #212529;
    }
    .header small {
      color: #6c757d;
    }
    #clock {
      font-style: italic;
      color: #6c757d;
    }
    footer {
      background: #f8f9fa;
      color: #6c757d;
      padding: 15px 0;
      text-align: center;
      border-top: 1px solid #dee2e6;
      margin-top: auto;
    }
    footer a {
      color: #0d6efd;
      text-decoration: none;
    }
    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<?php $this->beginBody(); ?>

<div class="d-flex">
  <!-- Sidebar -->
  <nav class="sidebar">
    <div class="logo-container">
      <?= Html::img('@web/uploads/imagenes/logo.png', ['alt' => 'Logo Portal UTH']) ?>
    </div>
    <h4>🎓 Coordinador</h4>
    <?= Html::a('<i class="bi bi-speedometer2"></i> Dashboard', Url::to(['coordinador/dashboard']), ['class'=>'nav-link']) ?>
    <?= Html::a('<i class="bi bi-folder-check"></i> Solicitudes', Url::to(['coordinador/solicitudes']), ['class'=>'nav-link']) ?>
    <?= Html::a('<i class="bi bi-award"></i> Becas', Url::to(['coordinador/becas']), ['class'=>'nav-link']) ?>
    <?= Html::a('<i class="bi bi-people"></i> Soporte', Url::to(['coordinador/soporte']), ['class'=>'nav-link']) ?>
    <form method="post" action="<?= Url::to(['site/logout']) ?>" style="display: inline;">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>" />
        <button type="submit" class="btn btn-link nav-link p-0 border-0 bg-transparent" style="width: 100%; text-align: left; padding: 10px 15px !important; color: #495057; text-decoration: none;" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </button>
    </form>
  </nav>

  <!-- Contenido -->
  <div class="content flex-fill">
    <div class="header">
      <div>
        <h5>Bienvenido(a), <?= Html::encode(Yii::$app->user->identity->nombre_completo) ?></h5>
        <small>Portal de Becas — Universidad Tecnológica de Huejotzingo</small>
      </div>
      <div id="clock"></div>
    </div>

    <?= $content ?>

    <footer>
      <p>© <?= date('Y') ?> Universidad Tecnológica de Huejotzingo | Coordinación de Becas</p>
    </footer>
  </div>
</div>

<script>
  function updateClock() {
    const now = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('clock').innerHTML =
      now.toLocaleDateString('es-ES', options) + ' | ' + now.toLocaleTimeString('es-ES');
  }
  setInterval(updateClock, 1000);
  updateClock();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
