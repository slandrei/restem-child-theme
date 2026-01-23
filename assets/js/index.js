/* var tippy; */

const domReady = () => {
    // DOM is fully loaded and parsed

    initTippyTooltips();
};

const initTippyTooltips = () => {
    if (!tippy) {
        return;
    }

    const tooltips = document.querySelectorAll('[data-tippy-content]:not(.tippy-initialized)');
    for (let tooltip of tooltips) {
        tooltip.classList.add('tippy-initialized');
    }

    if (tooltips.length > 0) {
        tippy(tooltips, {
            //animation: 'shift-away',
            //theme: 'light',
            appendTo: (reference) => {
                const dialog = reference.closest('dialog[open]');
                return dialog || document.body;
            },
            //zIndex: 999999,
            //strategy: 'absolute'
        });
    }

}

document.addEventListener('DOMContentLoaded', domReady);
