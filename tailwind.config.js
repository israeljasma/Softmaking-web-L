module.exports = {
  future: {
    // removeDeprecatedGapUtilities: true,
    // purgeLayersByDefault: true,
  },
  purge: [],
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
  variants: {},
  plugins: [],
}
