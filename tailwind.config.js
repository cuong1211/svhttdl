import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors');
import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                roboto: ['Roboto', 'sans-serif'],
                anton: ['Anton', 'sans-serif'],
            },
        },
        keyframes: {
            bounceHorizontal: {
                '0%, 100%': {
                    transform: 'translateX(-25%)',
                    'animation-timing-function': 'cubic-bezier(0.8, 0, 1, 1)',
                },
                '50%': {
                    transform: 'translateX(0)',
                    'animation-timing-function': 'cubic-bezier(0, 0, 0.2, 1)',
                },
            },
        },
        animation: {
            bounceHorizontal: 'bounceHorizontal 1s infinite',
        },
        colors: {
            red: colors.red,
            black: colors.black,
            slate: colors.slate,
            white: colors.white,
            green: colors.green,
            transparent: 'transparent',
            blue: {
                '50': '#f1f6fd',
                '100': '#e0eaf9',
                '200': '#c8daf5',
                '300': '#a2c3ee',
                '400': '#76a3e4',
                '500': '#5683db',
                '600': '#4169cf',
                '700': '#3653b7',
                '800': '#33479a',
                '900': '#2d3e7b',
                '950': '#20284b',
            },

        }
    },

    plugins: [
        forms,
        daisyui,
        require('tailwind-scrollbar-hide')
    ],
};
