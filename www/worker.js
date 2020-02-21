importScripts('/js/google/workbox.js');

if (workbox) {
    console.log(`Yay! Workbox is loaded 🎉`);

    workbox.routing.registerRoute(
        // Cache image files.
        /\.(?:png|jpg|jpeg|svg|gif)$/,
        // Use the cache if it's available.
        new workbox.strategies.NetworkFirst({
            // Use a custom cache name.
            cacheName: 'image-cache',
            plugins: [
                new workbox.expiration.Plugin({
                    // Cache only 20 images.
                    maxEntries: 20,
                    // Cache for a maximum of a week.
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                })
            ],
        })
    );

    workbox.routing.registerRoute(
        // Cache image files.
        /\.(?:html|htm|xhtml)$/,
        // Use the cache if it's available.
        new workbox.strategies.NetworkFirst({
            // Use a custom cache name.
            cacheName: 'html-cache',
            plugins: [
                new workbox.expiration.Plugin({
                    // Cache only 20 images.
                    maxEntries: 20,
                    // Cache for a maximum of a week.
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                })
            ],
        })
    );

    workbox.routing.registerRoute(
        // Cache image files.
        /\.(?:css|scss)$/,
        // Use the cache if it's available.
        new workbox.strategies.NetworkFirst({
            // Use a custom cache name.
            cacheName: 'css-cache',
            plugins: [
                new workbox.expiration.Plugin({
                    // Cache only 20 images.
                    maxEntries: 20,
                    // Cache for a maximum of a week.
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                })
            ],
        })
    );

    workbox.routing.registerRoute(
        // Cache image files.
        /\.(?:json)$/,
        // Use the cache if it's available.
        new workbox.strategies.NetworkFirst({
            // Use a custom cache name.
            cacheName: 'json-cache',
            plugins: [
                new workbox.expiration.Plugin({
                    // Cache only 20 images.
                    maxEntries: 20,
                    // Cache for a maximum of a week.
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                })
            ],
        })
    );

    workbox.routing.registerRoute(
        // Cache image files.
        /\.(?:js)$/,
        // Use the cache if it's available.
        new workbox.strategies.NetworkFirst({
            // Use a custom cache name.
            cacheName: 'js-cache',
            plugins: [
                new workbox.expiration.Plugin({
                    // Cache only 20 images.
                    maxEntries: 20,
                    // Cache for a maximum of a week.
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                })
            ],
        })
    );
} else {
  console.log(`Boo! Workbox didn't load 😬`);
}