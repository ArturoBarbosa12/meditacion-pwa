// Nombre del caché y archivos para almacenar
var staticCacheName = "pwa-" + new Date().getTime();
var filesToCache = [
    '/', // Página principal

];

// Instalación del Service Worker
self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(staticCacheName).then(function(cache) {
            return cache.addAll(filesToCache);
        })
    );
});

// Activación del Service Worker: Limpia cachés viejas
self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames
                    .filter(function(cacheName) {
                        return cacheName.startsWith("pwa-") && cacheName !== staticCacheName;
                    })
                    .map(function(cacheName) {
                        return caches.delete(cacheName);
                    })
            );
        })
    );
});

// Manejo de solicitudes con caché
self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request).then(function(response) {
            return response || fetch(event.request).catch(function() {
                // Si falla, devuelve la página offline
                return caches.match('/offline');
            });
        })
    );
});


