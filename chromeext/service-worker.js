self.addEventListener('install', function(event) {
    console.log('Service Worker установлен');
});

self.addEventListener('activate', function(event) {
    console.log('Service Worker активирован');
});
