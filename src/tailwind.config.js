import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        // resources/ts配下のコンポーネントファイルに適用させる
        './resources/ts/**/*.jsx',
        './resources/ts/**/*.tsx',
    ],

    theme: {
        extend: {

            // Tailwind内におけるレスポンシブ幅設定
            // sm: min-width:640px; (640px以上の時に適用)
            // md: min-width:768px; (768px以上の時に適用)
            // lg: min-width:1024px; (1024px以上の時に適用)
            // xl: min-width:1280px; (1280px以上の時に適用)

            // フォントサイズ
            fontSize: {
                size90: '90%',
            },

            // カラーパレット
            colors: {
                black: '#111111',
                white: '#EEEEEE',
                translucent: 'rgba(31,41,55,0.8)',
            },

            // 画面幅
            width: {
                content_lg: 'calc(100% - 18rem)',
                id: '10rem',
                // 2rem: アイコン幅
                // 1rem: ml-2 + mr-2
                // 0.5rem: 右側の余白
                post: 'calc(100% - 2rem - 1rem - 0.5rem)',
            }

        },
    },

    plugins: [forms],
};
