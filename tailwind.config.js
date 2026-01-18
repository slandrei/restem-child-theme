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
            colors: {
                primary: '#e11d48',
                "kubio-color-1": "rgb(176, 118, 87)",
                "kubio-color-6": "rgb(33, 30, 31)",
            }
        }
    }
}
