/* var tippy; */

const domReady = () => {
    // DOM is fully loaded and parsed

    initTippyTooltips();

    window.addEventListener('popstate', function(event) {
        // Only reload if the navigation was initiated by a back/forward click
        // and not by the initial page load.
        window.location.reload();
    });
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
