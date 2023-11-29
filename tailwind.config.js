import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
            },

            borderRadius: {
                'custom': '95% 4% 97% 5% / 4% 94% 3% 95%'
            },

            backgroundColor : {
                'brown' : '#C3AE89'
            }
        },
    },

    plugins: [forms],
};
