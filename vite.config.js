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
    // build: {
    //     outDir: 'public/build',
    // },
    // server: {
    //     host: '198.54.114.151',
    //     port: 21098,
    //     hmr: {
    //         host: 'svhttdl.thaivancuong.studio',
    //         protocol: 'wss',
    //     },
    // },
});
