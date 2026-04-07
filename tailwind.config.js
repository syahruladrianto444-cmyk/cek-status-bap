/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                // Government Dark Blue
                primary: {
                    50: '#e8edf5',
                    100: '#c5d1e8',
                    200: '#9eb3d9',
                    300: '#7795ca',
                    400: '#597ebe',
                    500: '#3b67b2',
                    600: '#345fab',
                    700: '#2c54a2',
                    800: '#244a99',
                    900: '#16398a',
                    950: '#0c1f4a',
                },
                // Gold Accent
                gold: {
                    50: '#fef9e7',
                    100: '#fcf0c3',
                    200: '#fae69b',
                    300: '#f7dc73',
                    400: '#f5d455',
                    500: '#f3cc37',
                    600: '#e6b30a',
                    700: '#c49608',
                    800: '#a17b07',
                    900: '#7f6105',
                },
                // Government accent colors
                govt: {
                    dark: '#0c1f4a',
                    blue: '#1a3a6b',
                    navy: '#142952',
                    light: '#f0f4fa',
                },
            },
            fontFamily: {
                sans: ['Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
