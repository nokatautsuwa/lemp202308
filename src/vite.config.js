import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/sass/user/app.scss",
                "resources/sass/user/auth.scss",
                "resources/sass/admin/app.scss",
                "resources/sass/admin/auth.scss",
            ],
            refresh: true,
        }),
        react(),
    ],
});
