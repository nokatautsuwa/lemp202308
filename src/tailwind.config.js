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

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            // カラーパレット
            colors: {
                navy: {
                    50: '#EFF6FF',
                    100: '#D5DFF0',
                    200: '#B4C8EA',
                },
                yellow: '#EAAC2F',
                black: {
                    100: '#999999',
                    900: '#111111',
                },
                white: {
                    100: '#CCCCCC',
                    900: '#EEEEEE',
                }
            },

        },
    },

    plugins: [forms],
};
