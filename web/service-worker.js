// web/service-worker.js
const CACHE_NAME = 'modulo-becas-cache-v5';
const OFFLINE_URL = '/offline.php';

const PRECACHE_URLS = [
  '/', 
  '/index.php',
  '/manifest.json',
  '/css/app.css',
  '/css/site.css',
  '/js/app.js',
  '/js/idb-helper.js',
  OFFLINE_URL,
  '/icons/icon-192.png',
  '/icons/icon-512.png'
];

/* ============================================================
   ⚠ INSTALACIÓN ROBUSTA PARA EVITAR FALLOS
   Evita que el SW falle si alguna URL del precache es 302/403/500.
============================================================ */
self.addEventListener('install', (event) => {
  event.waitUntil((async () => {
    const cache = await caches.open(CACHE_NAME);

    for (const url of PRECACHE_URLS) {
      try {
        const resp = await fetch(url, { cache: 'no-cache' });
        if (resp && resp.ok) {
          await cache.put(url, resp.clone());
        } else {
          console.warn('[SW] No se pudo precachear:', url, resp.status);
        }
      } catch (err) {
        console.warn('[SW] Error precacheando:', url, err);
      }
    }

    // Asegurar offline.php
    try {
      const exists = await cache.match(OFFLINE_URL);
      if (!exists) {
        const r = await fetch(OFFLINE_URL);
        if (r.ok) cache.put(OFFLINE_URL, r.clone());
      }
    } catch (e) {
      console.warn('[SW] No se pudo garantizar offline.php', e);
    }

    await self.skipWaiting();
  })());
});

/* ============================================================
   ⚠ ACTIVACIÓN Y LIMPIEZA DE VERSIONES ANTERIORES
============================================================ */
self.addEventListener('activate', (event) => {
  event.waitUntil((async () => {
    const keys = await caches.keys();
    await Promise.all(keys.map(k => {
      if (k !== CACHE_NAME) return caches.delete(k);
    }));
    await self.clients.claim();
  })());
});

/* ============================================================
   Helper para cache-first
============================================================ */
async function tryCacheFirst(request) {
  const cache = await caches.open(CACHE_NAME);
  const match = await cache.match(request);
  if (match) return match;

  try {
    const resp = await fetch(request);
    if (
      request.method === 'GET' &&
      resp.ok &&
      resp.type !== 'opaque'
    ) {
      cache.put(request, resp.clone());
    }
    return resp;
  } catch (e) {
    return null;
  }
}

/* ============================================================
   ⚠ CONTROL DE FALLO DE INTERNET (MOSTRAR offline.php)
============================================================ */
self.addEventListener('fetch', (event) => {
  const req = event.request;

  // Peticiones de navegación (HTML)
  if (
    req.mode === 'navigate' ||
    (req.method === 'GET' && req.headers.get('accept')?.includes('text/html'))
  ) {
    event.respondWith((async () => {
      try {
        return await fetch(req);
      } catch (err) {
        console.warn('[SW] OFFLINE: sirviendo offline.php');
        const cache = await caches.open(CACHE_NAME);
        const fallback = await cache.match(OFFLINE_URL);
        return fallback || new Response(
          '<h1>Sin conexión</h1>',
          { headers: { 'Content-Type': 'text/html' } }
        );
      }
    })());
    return;
  }

  // Recursos estáticos
  event.respondWith((async () => {
    const cached = await tryCacheFirst(req);
    if (cached) return cached;

    try {
      return await fetch(req);
    } catch (e) {
      return new Response(null, { status: 504, statusText: 'Gateway Timeout' });
    }
  })());
});

/* ============================================================
   Mensajes desde páginas (RELOAD)
============================================================ */
self.addEventListener('message', (event) => {
  if (event.data?.type === 'RELOAD_CLIENTS') {
    self.clients.matchAll().then(clients => {
      clients.forEach(c => c.postMessage({ type: 'RELOAD' }));
    });
  }
});
