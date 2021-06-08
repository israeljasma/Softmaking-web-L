const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                lightBlue: colors.lightBlue,
                blue: {
                    100: '#EBF8FF',
                    200: '#BEE3F8',
                    300: '#90CDF4',
                    400: '#63B3ED',
                    500: '#4299E1',
                    600: '#3182CE',
                    700: '#2B6CB0',
                    800: '#2C5282',
                    900: '#2A4365',
                },
            },
            inset: {
                '-24': '-1.5rem',
                '-16': '-4rem',
            },
            zIndex: {
                '-10': '-10'
            },
            animation: {
                'zoominout': 'zoominout 30s ease-in-out alternate infinite',
            },
            keyframes: {
                zoominout: {
                    '0%': { transform: 'scale(1.1)' },
                    '100%': { transform: 'scale(1.2, 1.2)' },
                }
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require( '@tailwindcss/forms' ),
        require( '@tailwindcss/aspect-ratio' ),
    ],
}
