<?php
// web/offline.php
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modo Sin Conexión - Sistema de Becas</title>

  <!-- Vincula el manifiesto y los estilos -->
  <link rel="manifest" href="/manifest.json">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJxjK+3A1+9cfGfB4Xy6Zigzm6a5Xy6g0gZxDz91LJGqzFqaAW5ey/gqehs9" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

  <!-- Script de IDB Helper -->
  <script src="/js/idb-helper.js"></script>

  <!-- Estilos personalizados mejorados -->
  <style>
    :root {
      --primary-color: #007bff;
      --primary-dark: #0056b3;
      --success-color: #28a745;
      --warning-color: #ffc107;
      --danger-color: #dc3545;
      --light-color: #f8f9fa;
      --dark-color: #343a40;
      --gray-color: #6c757d;
      --border-radius: 12px;
      --box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s ease;
    }

    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card {
      max-width: 500px;
      width: 100%;
      border: none;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      overflow: hidden;
      transition: var(--transition);
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .card-header {
      background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
      color: white;
      text-align: center;
      padding: 20px;
      border-bottom: none;
    }

    .card-header i {
      font-size: 1.8rem;
      margin-right: 10px;
    }

    .card-body {
      padding: 30px;
      background-color: white;
    }

    .btn-primary {
      background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-weight: 600;
      transition: var(--transition);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    .form-control {
      border-radius: 8px;
      padding: 12px 15px;
      border: 1px solid #e1e5eb;
      transition: var(--transition);
    }

    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .status-message {
      text-align: center;
      margin-top: 15px;
      font-weight: 600;
      padding: 10px;
      border-radius: 8px;
      transition: var(--transition);
    }

    .status-success {
      background-color: rgba(40, 167, 69, 0.1);
      color: var(--success-color);
      border: 1px solid rgba(40, 167, 69, 0.3);
    }

    .status-error {
      background-color: rgba(220, 53, 69, 0.1);
      color: var(--danger-color);
      border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .status-warning {
      background-color: rgba(255, 193, 7, 0.1);
      color: #856404;
      border: 1px solid rgba(255, 193, 7, 0.3);
    }

    .offline-indicator {
      background-color: rgba(220, 53, 69, 0.1);
      border: 1px solid rgba(220, 53, 69, 0.3);
      color: var(--danger-color);
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
      text-align: center;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .offline-indicator i {
      margin-right: 8px;
    }

    .connection-status {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .connection-online {
      color: var(--success-color);
    }

    .connection-offline {
      color: var(--danger-color);
    }

    .features-list {
      margin: 20px 0;
      padding-left: 20px;
    }

    .features-list li {
      margin-bottom: 8px;
      color: var(--gray-color);
    }

    .loading {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 3px solid rgba(255,255,255,.3);
      border-radius: 50%;
      border-top-color: #fff;
      animation: spin 1s ease-in-out infinite;
      margin-right: 10px;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--gray-color);
      cursor: pointer;
    }

    .password-container {
      position: relative;
    }

    .logo {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo img {
      max-height: 60px;
    }

    .footer-text {
      text-align: center;
      margin-top: 20px;
      color: var(--gray-color);
      font-size: 0.9rem;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-wifi-slash"></i> Modo Sin Conexión
      </div>
      <div class="card-body">
        <!-- Indicador de estado de conexión -->
        <div class="connection-status" id="connectionStatus">
          <i class="fas fa-wifi"></i> <span id="connectionText">Verificando conexión...</span>
        </div>

        <!-- Indicador offline -->
        <div class="offline-indicator" id="offlineIndicator">
          <i class="fas fa-exclamation-triangle"></i> Estás sin conexión. Puedes iniciar sesión con credenciales guardadas.
        </div>

        <!-- Logo (opcional) -->
        <div class="logo">
          <i class="fas fa-graduation-cap" style="font-size: 3rem; color: var(--primary-color);"></i>
          <h3 style="margin-top: 10px; color: var(--dark-color);">Sistema de Becas</h3>
        </div>

        <p class="text-muted text-center">Las credenciales se guardarán localmente para acceso offline y se sincronizarán cuando recuperes la conexión.</p>

        <!-- Formulario de Login Offline -->
        <form id="offlineLoginForm">
          <div class="mb-3">
            <label for="offlineEmail" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="offlineEmail" placeholder="usuario@ejemplo.com" required>
          </div>
          <div class="mb-3 password-container">
            <label for="offlinePassword" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="offlinePassword" placeholder="Ingresa tu contraseña" required>
            <button type="button" class="password-toggle" id="passwordToggle">
              <i class="fas fa-eye"></i>
            </button>
          </div>
          <button type="submit" class="btn btn-primary" id="offlineLoginBtn">
            <span id="loginText">Iniciar sesión</span>
            <div class="loading" id="loginLoading" style="display: none;"></div>
          </button>
        </form>

        <!-- Mensaje de estado -->
        <div id="offlineStatus" class="status-message"></div>

        <!-- Información adicional -->
        <div class="mt-4">
          <h6 class="text-center">Funcionalidades disponibles offline:</h6>
          <ul class="features-list">
            <li>Inicio de sesión con credenciales guardadas</li>
            <li>Almacenamiento seguro de datos</li>
            <li>Sincronización automática al recuperar conexión</li>
          </ul>
        </div>
      </div>
    </div>
    
    <div class="footer-text">
      <p>Sistema de Becas &copy; <?php echo date('Y'); ?> - Modo Offline</p>
    </div>
  </div>

<script>
  // ======================================================
  // MEJORAS DE USABILIDAD Y FUNCIONALIDAD
  // ======================================================

  // Elementos del DOM
  const offlineLoginForm = document.getElementById('offlineLoginForm');
  const offlineEmail = document.getElementById('offlineEmail');
  const offlinePassword = document.getElementById('offlinePassword');
  const offlineLoginBtn = document.getElementById('offlineLoginBtn');
  const loginText = document.getElementById('loginText');
  const loginLoading = document.getElementById('loginLoading');
  const offlineStatus = document.getElementById('offlineStatus');
  const offlineIndicator = document.getElementById('offlineIndicator');
  const connectionStatus = document.getElementById('connectionStatus');
  const connectionText = document.getElementById('connectionText');
  const passwordToggle = document.getElementById('passwordToggle');

  // ======================================================
  // 1. DETECCIÓN MEJORADA DEL ESTADO DE CONEXIÓN
  // ======================================================
  function updateConnectionStatus() {
    const isOnline = navigator.onLine;
    
    if (isOnline) {
      connectionStatus.innerHTML = '<i class="fas fa-wifi connection-online"></i> <span class="connection-online">Conectado</span>';
      offlineIndicator.style.display = 'none';
    } else {
      connectionStatus.innerHTML = '<i class="fas fa-wifi-slash connection-offline"></i> <span class="connection-offline">Sin conexión</span>';
      offlineIndicator.style.display = 'flex';
    }
  }

  // Event listeners para cambios de conexión
  window.addEventListener('online', updateConnectionStatus);
  window.addEventListener('offline', updateConnectionStatus);

  // Inicializar estado de conexión
  updateConnectionStatus();

  // ======================================================
  // 2. TOGGLE PARA VISUALIZAR CONTRASEÑA
  // ======================================================
  passwordToggle.addEventListener('click', function() {
    const type = offlinePassword.getAttribute('type') === 'password' ? 'text' : 'password';
    offlinePassword.setAttribute('type', type);
    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
  });

  // ======================================================
  // 3. ANIMACIÓN DE CARGA MEJORADA
  // ======================================================
  function setLoadingState(loading) {
    if (loading) {
      loginText.textContent = 'Procesando...';
      loginLoading.style.display = 'inline-block';
      offlineLoginBtn.disabled = true;
    } else {
      loginText.textContent = 'Iniciar sesión';
      loginLoading.style.display = 'none';
      offlineLoginBtn.disabled = false;
    }
  }

  // ======================================================
  // 4. GESTIÓN DE BASE DE DATOS INDEXEDDB
  // ======================================================
  let userDB;

  function initUserDB() {
    return new Promise((resolve, reject) => {
      const req = indexedDB.open('moduloBecasDB', 2); // Incrementamos la versión

      req.onupgradeneeded = (e) => {
        const db = e.target.result;
        if (!db.objectStoreNames.contains('users')) {
          const store = db.createObjectStore('users', { keyPath: 'email' });
          // Crear índice para búsquedas más eficientes
          store.createIndex('timestamp', 'ts', { unique: false });
        }
        
        // Agregar store para logs si no existe
        if (!db.objectStoreNames.contains('login_logs')) {
          db.createObjectStore('login_logs', { keyPath: 'id', autoIncrement: true });
        }
      };

      req.onsuccess = (e) => {
        userDB = e.target.result;
        resolve();
      };

      req.onerror = () => reject(req.error);
    });
  }

  // ======================================================
  async function saveLocalUser(email, passwordHash) {
    await initUserDB();

    return new Promise((resolve, reject) => {
      const tx = userDB.transaction('users', 'readwrite');
      tx.objectStore('users').put({ 
        email, 
        passwordHash, 
        ts: Date.now(),
        lastLogin: Date.now()
      });
      tx.oncomplete = () => resolve(true);
      tx.onerror = () => reject(tx.error);
    });
  }

  async function getLocalUser(email) {
    await initUserDB();

    return new Promise((resolve, reject) => {
      const tx = userDB.transaction('users', 'readonly');
      const req = tx.objectStore('users').get(email);

      req.onsuccess = () => resolve(req.result);
      req.onerror = () => reject(req.error);
    });
  }

  // ======================================================
  // 5. HASH MEJORADO PARA CONTRASEÑAS
  // ======================================================
  function simpleHash(s) {
    let h = 0;
    for (let i = 0; i < s.length; i++) {
      h = (Math.imul(31, h) + s.charCodeAt(i)) | 0;
    }
    return String(h);
  }

  // ======================================================
  // 6. GESTIÓN MEJORADA DE MENSAJES DE ESTADO
  // ======================================================
  function showStatus(msg, type = 'info') {
    offlineStatus.textContent = msg;
    offlineStatus.className = 'status-message';
    
    switch(type) {
      case 'success':
        offlineStatus.classList.add('status-success');
        break;
      case 'error':
        offlineStatus.classList.add('status-error');
        break;
      case 'warning':
        offlineStatus.classList.add('status-warning');
        break;
      default:
        // Sin clase adicional para info
    }
    
    // Auto-ocultar mensajes de éxito después de 5 segundos
    if (type === 'success') {
      setTimeout(() => {
        if (offlineStatus.textContent === msg) {
          offlineStatus.textContent = '';
          offlineStatus.className = 'status-message';
        }
      }, 5000);
    }
  }

  // ======================================================
  // 7. GUARDADO DE LOGIN PENDIENTE PARA SINCRONIZACIÓN
  // ======================================================
  async function saveLoginPending(email, passwordHash) {
    if (!window.IDBHelper) {
      console.error("idb-helper.js no cargó");
      return false;
    }

    try {
      await IDBHelper.addRecord({
        tipo: "login-pendiente",
        correo: email,
        passwordHash,
        timestamp: new Date().toISOString()
      });

      console.log("✔ Login pendiente guardado para sincronización");
      return true;
    } catch (error) {
      console.error("Error guardando login pendiente:", error);
      return false;
    }
  }

  // ======================================================
  // 8. HANDLER PRINCIPAL DEL FORM MEJORADO
  // ======================================================
  offlineLoginForm.addEventListener('submit', async (ev) => {
    ev.preventDefault();
    setLoadingState(true);

    const email = offlineEmail.value.trim();
    const password = offlinePassword.value;

    if (!email || !password) {
      setLoadingState(false);
      return showStatus("Por favor, completa todos los campos", 'error');
    }

    // Validación básica de email
    if (!/^\S+@\S+\.\S+$/.test(email)) {
      setLoadingState(false);
      return showStatus("Por favor, ingresa un correo electrónico válido", 'error');
    }

    const hash = simpleHash(password);

    try {
      // ---------------------------------------------
      // 🔵 PASO 1: Guardar usuario localmente
      // ---------------------------------------------
      await saveLocalUser(email, hash);
      console.log("✔ Usuario guardado localmente");

      // ---------------------------------------------
      // 🔵 PASO 2: Guardar para sincronización
      // ---------------------------------------------
      const savedForSync = await saveLoginPending(email, hash);

      // ---------------------------------------------
      // 🔵 PASO 3: Si hay internet → intentar login real
      // ---------------------------------------------
      if (navigator.onLine) {
        try {
          const resp = await fetch('/site/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ login: email, password: password })
          });

          if (resp.ok) {
            showStatus("Login ONLINE correcto. Sincronizando...", 'success');
            setTimeout(() => {
              notifySWReload();
            }, 1500);
            setLoadingState(false);
            return;
          } else {
            showStatus("Credenciales incorrectas en servidor", 'warning');
          }
        } catch (err) {
          console.warn("No se pudo contactar servidor:", err);
        }
      }

      // ---------------------------------------------
      // 🔵 PASO 4: LOGIN OFFLINO
      // ---------------------------------------------
      const local = await getLocalUser(email);

      if (local && local.passwordHash === hash) {
        showStatus("✔ Login OFFLINE exitoso. Se sincronizará cuando recuperes conexión", 'success');
        setTimeout(() => {
          notifySWReload();
        }, 2000);
      } else {
        showStatus("No se encontró usuario guardado localmente", 'error');
      }

    } catch (error) {
      console.error("Error durante el proceso de login:", error);
      showStatus("Error inesperado. Intenta nuevamente.", 'error');
    } finally {
      setLoadingState(false);
    }
  });

  // ======================================================
  // 9. NOTIFICACIÓN AL SERVICE WORKER
  // ======================================================
  function notifySWReload() {
    if (navigator.serviceWorker && navigator.serviceWorker.controller) {
      navigator.serviceWorker.controller.postMessage({ 
        type: "RELOAD_CLIENTS",
        source: "offline-login"
      });
    }
    
    // Intentar recargar la página principal después de un breve delay
    setTimeout(() => {
      window.location.href = '/';
    }, 1000);
  }

  // ======================================================
  // 10. INTENTAR CARGAR USUARIO GUARDADO AL INICIAR
  // ======================================================
  document.addEventListener('DOMContentLoaded', async function() {
    // Intentar cargar el último usuario utilizado
    try {
      await initUserDB();
      const tx = userDB.transaction('users', 'readonly');
      const store = tx.objectStore('users');
      const index = store.index('timestamp');
      const req = index.openCursor(null, 'prev'); // Obtener el más reciente
      
      req.onsuccess = function() {
        const cursor = req.result;
        if (cursor) {
          offlineEmail.value = cursor.value.email;
          // No cargamos la contraseña por seguridad
        }
      };
    } catch (error) {
      console.log("No se pudo cargar usuario previo:", error);
    }
  });

</script>
</body>
</html>