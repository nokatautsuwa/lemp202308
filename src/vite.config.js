import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import path from 'path' // 追加

export default defineConfig({
    resolve: {
        alias: {
            // 各コンポーネントの'@'が参照するルートディレクトリを変更する
            // pathモジュールをインポートして'現在のワーキングディレクトリ/resources/ts'に変える
            '@': path.resolve(process.cwd(), 'resources/ts'),
        },
    },
    plugins: [
        laravel({
            input: [
                // "resources/js/app.jsx",
                "resources/ts/app.jsx",
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
