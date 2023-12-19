/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    plugins: [
        require('flowbite/plugin')
    ],
    darkMode: 'class',
    theme: {
        extend: {
        }
    }
}

