// ===============================
// App Shell + Carga Progresiva
// ===============================
document.addEventListener('DOMContentLoaded', () => {
  const content = document.getElementById('content');
  if (content) {
    content.innerHTML = '<p>Aplicación lista. Intentando obtener datos...</p>';

    // Ejemplo de carga dinámica desde backend
    fetch('/api/ejemplo')
      .then(r => r.json())
      .then(data => {
        content.innerHTML =
          '<h3>Datos obtenidos del servidor:</h3>' +
          '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
      })
      .catch(err => {
        console.warn('No se pudieron obtener datos', err);
        content.innerHTML += `
          <p style="color:red;">
            No se pudo conectar con el servidor.<br>
            Mostrando versión offline o datos en caché.
          </p>`;
      });
  }
});

// ===============================
// Manejo de instalación PWA (REMOVIDO - Ahora está en main.php)
// ===============================
// Este código fue movido al layout principal para evitar conflictos