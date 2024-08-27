import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from "tailwindcss/colors";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                neutral: colors.stone,
                primary: colors.zinc,
                secondary: colors.orange,
                accent: colors.fuchsia
            },
            fontFamily: {
                sans: ['Hanken Grotesk', ...defaultTheme.fontFamily.sans],
            },
            transitionDuration: {
                DEFAULT: '150ms'
            },
            transitionTimingFunction: {
                DEFAULT: 'cubic-bezier(0.25, 0.1, 0.25, 1.0)'
            }
        },
    },

    plugins: [forms],
};
