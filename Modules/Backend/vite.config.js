import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: import.meta.dirname + '/../../public/build-backend',
        emptyOutDir: true,
        manifest: 'manifest.json',
    },
    plugins: [
        laravel({
            publicDirectory: import.meta.dirname + '/../../public',
            buildDirectory: 'build-backend',
            hotFile: import.meta.dirname + '/../../storage/vite-backend.hot',
            input: [
                import.meta.dirname + '/resources/assets/sass/app.scss',
                import.meta.dirname + '/resources/assets/css/style.css',
                import.meta.dirname + '/resources/assets/js/app.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            port: 5174,
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
