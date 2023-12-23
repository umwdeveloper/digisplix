import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/light-sass/light.scss', 'resources/css/dark-sass/dark.scss'],
            refresh: true,
        }),
    ],
    build: {
        fileNameHashing: false,
        minify: false,
        rollupOptions: {
            output: {
                entryFileNames: `[name].js`,
                chunkFileNames: `[name].js`,
                assetFileNames: function (file) {
                    if (file.name.includes('light-sass')) {
                        return 'light.css';
                    } else if (file.name.includes('dark-sass')) {
                        return 'dark.css';
                    } else {
                        return '[name].[ext]';
                    }

                }
            }
        }
    }
});
