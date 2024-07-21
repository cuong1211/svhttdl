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
    build: {
        outDir: 'public/build',
    },
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'khuyennongvanho.tuaf.edu.vn',
            protocol: 'wss',
        },
    },
});
