import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: 'storytail.acount.local',
        origin: '0.0.0.0:8000',
        hmr: {
            host: 'localhost',
        }
    }
});
