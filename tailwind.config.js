export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                // Couleurs principales - Identité Centre de Santé Ouando
                'medical': {
                    50: '#e8f5e9',
                    100: '#c8e6c9',
                    200: '#a5d6a7',
                    300: '#81c784',
                    400: '#66bb6a',
                    500: '#0B5E42',   // Vert signature
                    600: '#2e7d32',
                    700: '#1b5e20',
                    800: '#0B5E42',
                    900: '#0B5E42',
                },
                'primary': {
                    50: '#e0f2f1',
                    100: '#b2dfdb',
                    200: '#80cbc4',
                    300: '#4db6ac',
                    400: '#26a69a',
                    500: '#0D9488',   // Teal
                    600: '#0f766e',
                    700: '#0f766e',
                    800: '#115e59',
                    900: '#134e4a',
                },
                'accent': {
                    50: '#fef3e8',
                    100: '#fde4d0',
                    200: '#fbc8a2',
                    300: '#f9ab73',
                    400: '#f78f45',
                    500: '#F59E0B',   // Orange
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
                'danger': {
                    500: '#DC2626',
                },
                'success': {
                    500: '#10B981',
                },
                'info': {
                    500: '#3B82F6',
                },
            },
            fontFamily: {
                'sans': ['Inter', 'system-ui', 'sans-serif'],
            },
            boxShadow: {
                'card': '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)',
                'card-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
            },
            borderRadius: {
                'xl': '1rem',
                '2xl': '1.5rem',
            },
        },
    },
    plugins: [],
}