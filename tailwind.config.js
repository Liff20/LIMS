import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    DEFAULT: '#166083',
                    50: '#eff7fb',
                    100: '#dceef7',
                    200: '#b9ddef',
                    300: '#8cc6e4',
                    400: '#4d9ecb',
                    500: '#166083',
                    600: '#125174',
                    700: '#104560',
                    800: '#0e3a50',
                    900: '#0c3042',
                },
                sky: {
                    light: '#8ecae6',
                },
                'blue-green': {
                    DEFAULT: '#166083',
                    50: '#eff7fb',
                    100: '#dceef7',
                    200: '#b9ddef',
                    300: '#8cc6e4',
                    400: '#166083',
                    500: '#125174',
                    600: '#104560',
                },
                'deep-space': {
                    DEFAULT: '#104560',
                    50: '#f7fbff',
                    100: '#ebf4ff',
                    200: '#dceef7',
                    300: '#b9ddef',
                    400: '#166083',
                    500: '#125174',
                    600: '#104560',
                    700: '#0f172a',
                    800: '#0c3042',
                    900: '#0a2838',
                },
                amber: {
                    flame: '#f4c542',
                },
                orange: {
                    princeton: '#d97706',
                },
            },
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                soft: '0 12px 30px rgba(2, 6, 23, 0.08)',
                card: '0 12px 30px rgba(2, 6, 23, 0.10)',
                lift: '0 20px 50px rgba(2, 6, 23, 0.16)',
                glow: '0 8px 24px rgba(22, 96, 131, 0.22)',
            },
            backgroundImage: {
                'gradient-brand': 'linear-gradient(135deg, #104560 0%, #166083 100%)',
                'gradient-accent': 'linear-gradient(135deg, #f4c542 0%, #fb8500 100%)',
            },
            animation: {
                float: 'float 8s ease-in-out infinite',
                'float-slow': 'float 12s ease-in-out infinite',
                shimmer: 'shimmer 2.5s linear infinite',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-20px)' },
                },
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
            },
        },
    },
    plugins: [],
};
