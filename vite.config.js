import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/light-sass/main.scss', 'resources/css/dark-sass/main.scss'],
            refresh: true,
        }),
    ],
    build: {
        minify: false
    }
});
