import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/rating.js',
            ],
            refresh: false,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 3000,
        hmr: {
            host: 'localhost',
            port: 8000
        }
    }
});
