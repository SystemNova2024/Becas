<?php
use yii\helpers\Html;

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>🎓 Portal Becas | Estudiante</title>
  <?php $this->head() ?>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f5f7fa;
    }
    .help-bar {
      background: #fff;
      color: #333;
      padding: 5px 0;
      font-size: .9rem;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }
    .help-bar a {
      color: #0d6efd;
      text-decoration: underline;
    }
    .sidebar {
      background: #fff;
      height: 100vh;
      padding: 20px 15px;
      border-right: 4px solid #0d6efd;
      box-shadow: 3px 0 8px rgba(13, 110, 253, 0.15);
      position: fixed;
      top: 0;
      left: 0;
      width: 220px;
      overflow-y: auto;
      transition: border-color 0.3s ease;
    }
    .sidebar .logo-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 30px;
    }
    .sidebar .logo-container img {
      max-width: 150px;
      margin-bottom: 20px;
    }
    .sidebar .navbar-brand {
      font-weight: 700;
      color: #000;
      text-decoration: none;
      text-align: center;
    }
    .sidebar .nav-link {
      color: #333;
      padding: 10px 15px;
      border-radius: 6px;
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
      transition: background-color 0.3s ease, color 0.3s ease;
      cursor: pointer;
    }
    .sidebar .nav-link:hover {
      background: #e6f0ff;
      color: #0d6efd;
      text-decoration: none;
    }
    .content {
      margin-left: 240px;
      padding: 20px;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    footer {
      background: #fff;
      color: #333;
      padding: 20px 0;
      margin-top: auto;
      font-size: .9rem;
      border-top: 1px solid #ddd;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    footer a {
      color: #0d6efd;
      text-decoration: underline;
      cursor: pointer;
    }
  </style>
</head>

<body>
<?php $this->beginBody(); ?>

<!-- Sidebar lateral con logo -->
<div class="sidebar">
  <div class="logo-container">
    <?= Html::img('@web/uploads/imagenes/logo.png', ['alt' => 'Logo Empresa']) ?>
    <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">Portal Estudiante</a>
  </div>
  <nav class="nav flex-column">
    <?= Html::a('Inicio', ['/estudiante/dashboard'], ['class' => 'nav-link']) ?>
    <?= Html::a('Mis Solicitudes', ['/estudiante/solicitudes'], ['class' => 'nav-link']) ?>
    <?= Html::a('Becas', ['/estudiante/becas'], ['class' => 'nav-link']) ?>
    <?= Html::a('Becas Institucionales', ['/estudiante/becas-institucionales'], ['class' => 'nav-link']) ?>
    <?= Html::a('Cerrar Sesión', ['/estudiante/logout'], ['class' => 'nav-link','data-method'=>'post']) ?>
  </nav>
</div>

<!-- Contenido principal -->
<div class="content">
  <div class="d-flex justify-content-between align-items-center px-4 py-3 mb-4 bg-white border-bottom shadow-sm">
    <div>
      <h5 class="mb-1 fw-bold text-dark">
        Bienvenido(a), <?= Html::encode(Yii::$app->user->identity->nombre_completo) ?>
      </h5>
      <small class="text-muted">
        Portal de Becas — Universidad Tecnológica de Huejotzingo
      </small>
    </div>
    <div id="clock" class="text-muted fst-italic"></div>
  </div>

  <?= $content ?>

  <footer style="text-align: center; padding: 20px 0; background: #fff; border-top: 1px solid #ddd;">
    <p class="mb-0">© <?= date('Y') ?> Universidad Tecnológica de Huejotzingo | Todos los derechos reservados</p>
</footer>

<!-- Scripts -->
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
