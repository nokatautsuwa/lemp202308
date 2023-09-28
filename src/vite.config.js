import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/app.jsx",
                "resources/sass/app.scss",
                "resources/sass/auth/auth.scss",
                "resources/sass/profile/profile.scss",
                "resources/sass/profile/request.scss",
            ],
            refresh: true,
        }),
        react(),
    ],
});
