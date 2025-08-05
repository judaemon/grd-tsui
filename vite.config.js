import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [`resources/views/**/*`],
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost',
            protocol: 'ws',
            port: 5173,
        },
        // Allow CORS from specific dev origins.
        // Add your own local domain (or port) here if you're using a different setup.
        // Useful when running Vite behind a reverse proxy or using custom local domains.
        cors: {
            origin: ['http://grd-tsui.local', 'http://localhost:8080'],
            credentials: true
        }
    }
});
