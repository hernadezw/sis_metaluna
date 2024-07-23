import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        './app/Http/Livewire/**/*Table.php',
        './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
        './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                //primaryColor: '#f97316', //
                //secondaryColor: '#ffedd5', //#22d3ee
                primaryColor: '#f97316',
                secondaryColor: '#ffedd5',
                TertiaryColor: '#8DC0BC',
                cuartoColor:'#04B1B8',
                quintoColor:'#2A9EB8',
                sextoColor:'#082f49'

            },
        },
    },

    plugins: [forms],
};
