module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
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
