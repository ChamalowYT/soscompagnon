/**
 * SOS COMPAGNON - SERVICE WORKER
 * Progressive Web App avec cache offline
 */

const CACHE_VERSION = 'v1.0.0';
const CACHE_NAME = `soscompagnon-${CACHE_VERSION}`;

// Files to cache immediately on install
const STATIC_CACHE = [
  '/',
  '/index.php',
  '/css/main.css',
  '/js/main.js',
  '/manifest.json',
  '/img/logo.png',
  '/pwa/icons/icon-192.png',
  '/pwa/icons/icon-512.png'
];

// Cache strategies
const CACHE_STRATEGIES = {
  // Cache first, then network (for static assets)
  cacheFirst: [
    /\.css$/,
    /\.js$/,
    /\.woff2?$/,
    /\.png$/,
    /\.jpg$/,
    /\.jpeg$/,
    /\.webp$/,
    /\.svg$/,
    /\/pwa\/icons\//
  ],

  // Network first, then cache (for API calls)
  networkFirst: [
    /\/api\//
  ],

  // Network only (never cache)
  networkOnly: [
    /\/admin\//,
    /\/login/
  ]
};

// ===== INSTALL EVENT =====
self.addEventListener('install', (event) => {
  console.log('[SW] Installing Service Worker...', CACHE_VERSION);

  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        console.log('[SW] Caching static assets');
        return cache.addAll(STATIC_CACHE);
      })
      .then(() => self.skipWaiting())
  );
});

// ===== ACTIVATE EVENT =====
self.addEventListener('activate', (event) => {
  console.log('[SW] Activating Service Worker...', CACHE_VERSION);

  event.waitUntil(
    caches.keys()
      .then((cacheNames) => {
        return Promise.all(
          cacheNames
            .filter((name) => name !== CACHE_NAME)
            .map((name) => {
              console.log('[SW] Deleting old cache:', name);
              return caches.delete(name);
            })
        );
      })
      .then(() => self.clients.claim())
  );
});

// ===== FETCH EVENT =====
self.addEventListener('fetch', (event) => {
  const { request } = event;
  const url = new URL(request.url);

  // Skip non-GET requests
  if (request.method !== 'GET') {
    return;
  }

  // Skip cross-origin requests (except fonts)
  if (url.origin !== location.origin && !url.hostname.includes('fonts.g')) {
    return;
  }

  // Determine strategy
  const strategy = getStrategy(url.pathname);

  event.respondWith(
    strategy(request)
  );
});

// ===== CACHE STRATEGIES =====

// Cache First Strategy
async function cacheFirst(request) {
  const cached = await caches.match(request);
  if (cached) {
    return cached;
  }

  try {
    const response = await fetch(request);
    if (response.ok) {
      const cache = await caches.open(CACHE_NAME);
      cache.put(request, response.clone());
    }
    return response;
  } catch (error) {
    console.error('[SW] Cache First failed:', error);
    return new Response('Offline - ressource non disponible', {
      status: 503,
      statusText: 'Service Unavailable'
    });
  }
}

// Network First Strategy
async function networkFirst(request) {
  try {
    const response = await fetch(request);
    if (response.ok) {
      const cache = await caches.open(CACHE_NAME);
      cache.put(request, response.clone());
    }
    return response;
  } catch (error) {
    const cached = await caches.match(request);
    if (cached) {
      return cached;
    }
    console.error('[SW] Network First failed:', error);
    return new Response('Offline - impossible de récupérer les données', {
      status: 503,
      statusText: 'Service Unavailable'
    });
  }
}

// Network Only Strategy
async function networkOnly(request) {
  return fetch(request);
}

// Stale While Revalidate Strategy
async function staleWhileRevalidate(request) {
  const cached = await caches.match(request);

  const fetchPromise = fetch(request)
    .then((response) => {
      if (response.ok) {
        const cache = caches.open(CACHE_NAME);
        cache.then(c => c.put(request, response.clone()));
      }
      return response;
    })
    .catch(() => cached);

  return cached || fetchPromise;
}

// ===== STRATEGY SELECTOR =====
function getStrategy(pathname) {
  // Network only
  if (CACHE_STRATEGIES.networkOnly.some(pattern => pattern.test(pathname))) {
    return networkOnly;
  }

  // Network first (API calls)
  if (CACHE_STRATEGIES.networkFirst.some(pattern => pattern.test(pathname))) {
    return networkFirst;
  }

  // Cache first (static assets)
  if (CACHE_STRATEGIES.cacheFirst.some(pattern => pattern.test(pathname))) {
    return cacheFirst;
  }

  // Default: Stale while revalidate
  return staleWhileRevalidate;
}

// ===== BACKGROUND SYNC (for future use) =====
self.addEventListener('sync', (event) => {
  console.log('[SW] Background sync:', event.tag);

  if (event.tag === 'sync-data') {
    event.waitUntil(syncData());
  }
});

async function syncData() {
  // Implement background sync logic here
  console.log('[SW] Syncing data...');
}

// ===== PUSH NOTIFICATIONS (for future use) =====
self.addEventListener('push', (event) => {
  console.log('[SW] Push notification received');

  const options = {
    body: event.data ? event.data.text() : 'Nouvelle notification',
    icon: '/pwa/icons/icon-192.png',
    badge: '/pwa/icons/icon-96.png',
    vibrate: [200, 100, 200],
    data: {
      dateOfArrival: Date.now(),
      primaryKey: 1
    }
  };

  event.waitUntil(
    self.registration.showNotification('SOS Compagnon', options)
  );
});

self.addEventListener('notificationclick', (event) => {
  console.log('[SW] Notification clicked');
  event.notification.close();

  event.waitUntil(
    clients.openWindow('/')
  );
});

// ===== MESSAGE HANDLER =====
self.addEventListener('message', (event) => {
  console.log('[SW] Message received:', event.data);

  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }

  if (event.data && event.data.type === 'CLEAR_CACHE') {
    event.waitUntil(
      caches.keys().then((names) => {
        return Promise.all(names.map((name) => caches.delete(name)));
      })
    );
  }
});

console.log('[SW] Service Worker loaded:', CACHE_VERSION);
