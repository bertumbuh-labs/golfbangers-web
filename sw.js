/* GolfBangers PWA service worker */
const CACHE_VERSION = 'gb-pwa-v3';
const SHELL_CACHE = `${CACHE_VERSION}-shell`;

/* Hanya aset statis jarang berubah — JANGAN cache HTML/PHP di sini */
const SHELL_ASSETS = [
  '/manifest.webmanifest',
  '/icons/icon-192.png',
  '/icons/icon-512.png',
  '/icons/icon-192-maskable.png',
  '/icons/icon-512-maskable.png',
  '/icons/apple-touch-icon.png',
  '/icons/favicon-32.png',
  '/icons/favicon-16.png'
];

function isApiRequest(url) {
  return url.pathname.endsWith('/api.php') || url.pathname.includes('/api.php');
}

function isHtmlLike(request, url) {
  if (request.mode === 'navigate') return true;
  const path = url.pathname;
  return (
    path.endsWith('.php') ||
    path.endsWith('.html') ||
    path === '/' ||
    path.endsWith('/')
  );
}

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(SHELL_CACHE)
      .then((cache) => cache.addAll(SHELL_ASSETS))
      .then(() => self.skipWaiting())
      .catch(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) =>
      Promise.all(
        keys
          .filter((key) => key.startsWith('gb-pwa-') && key !== SHELL_CACHE)
          .map((key) => caches.delete(key))
      )
    ).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (event) => {
  const request = event.request;
  if (request.method !== 'GET') return;

  const url = new URL(request.url);
  if (url.origin !== self.location.origin) return;

  // API & live data: network only
  if (isApiRequest(url)) {
    event.respondWith(fetch(request));
    return;
  }

  // APK: network only
  if (url.pathname.endsWith('.apk')) {
    event.respondWith(fetch(request));
    return;
  }

  // Halaman HTML/PHP: network-first (selalu coba versi terbaru)
  // Offline fallback ke cache jika pernah berhasil di-cache sebelumnya
  if (isHtmlLike(request, url)) {
    event.respondWith(
      fetch(request)
        .then((response) => {
          if (response && response.ok && response.type === 'basic') {
            const copy = response.clone();
            caches.open(SHELL_CACHE).then((cache) => cache.put(request, copy));
          }
          return response;
        })
        .catch(() => caches.match(request))
    );
    return;
  }

  // Aset statis (ikon, dll.): cache-first
  event.respondWith(
    caches.match(request).then((cached) => {
      if (cached) return cached;
      return fetch(request).then((response) => {
        if (response && response.ok && response.type === 'basic') {
          const copy = response.clone();
          caches.open(SHELL_CACHE).then((cache) => cache.put(request, copy));
        }
        return response;
      });
    })
  );
});
