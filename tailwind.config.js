/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
              'sans': ['Open Sans', 'ui-sans-serif', 'system-ui'],
              'roboto': ['Roboto', 'ui-sans-serif', 'system-ui']
            },
        },
    },
    plugins: [require("@tailwindcss/typography")],
};
