
/* var tippy; */

const domReady = () => {
    // DOM is fully loaded and parsed

    initTippyElements();
};

const initTippyElements = () => {
    if (!tippy) {
        return;
    }

    tippy('[data-tippy-content]');
}

document.addEventListener('DOMContentLoaded', domReady);
