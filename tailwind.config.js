module.exports = {
    important: '.tw',
    content: [
        './**/*.php',
        './blocks/**/*.{php,js}',
        './template-parts/**/*.php',
        './assets/js/**/*.js',
    ],
    corePlugins: {
        preflight: false
    },
    theme: {
        extend: {
        }
    },
    safelist: [
        {
            pattern: /^bg-kubio-color-/, // Matches bg-kubio-color-1, bg-kubio-color-1-variant-1, etc.
            variants: ['hover', 'focus'], // Include hover states if you need them
        },
        {
            pattern: /^text-kubio-color-/,
        },
        {
            pattern: /^border-kubio-color-/,
        }
    ],
}
