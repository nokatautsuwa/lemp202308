import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // "resources/sass/app.scss",
                // "resources/js/app.js",
                'resources/react/App.tsx',
                'resources/react/Home.tsx',
                'resources/react/About.tsx',
                'resources/react/Test.tsx',
                'resources/react/User/Profile.tsx',
                "resources/sass/user/app.scss",
                "resources/sass/user/auth.scss",
                "resources/sass/user/profile.scss",
                "resources/sass/admin/app.scss",
                "resources/sass/admin/auth.scss",
                "resources/sass/admin/profile.scss",
                "resources/sass/admin/request.scss",
            ],
            refresh: true,
        }),
        react(),
    ],
});
