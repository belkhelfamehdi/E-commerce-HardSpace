import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        https: true, // Enable HTTPS
        proxy: {
          '/app': 'https://e-commerce-hardspace-production.up.railway.app/' // Adjust the proxy if needed
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/store.js',
                'resources/js/product.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});
