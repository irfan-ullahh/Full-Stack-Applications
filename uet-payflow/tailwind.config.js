/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/Livewire/**/*.php",
        "./app/Http/Livewire/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                // Add any custom colors you used
                muted: '#9ca3af',
                primary: '#ffffff',
            },
            animation: {
                // Add any custom animations
            },
            keyframes: {
                // Add any custom keyframes
            },
        },
    },
    plugins: [],
}