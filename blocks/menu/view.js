/**
 * View JS for the Menu block.
 */

(function () {
    const state = {
        isLoading: false
    };

    /**
     * Helper to perform AJAX requests.
     */
    const postAjax = async (action, data = {}) => {
        const fd = new FormData();
        fd.append('action', action);
        for (const key in data) {
            fd.append(key, data[key]);
        }

        try {
            const response = await fetch(restem_utils.ajaxurl, {
                method: 'POST',
                body: fd
            });
            if (!response.ok) throw new Error('Network response was not ok');
            return await response.text();
        } catch (error) {
            console.error('AJAX Error:', error);
            return null;
        }
    };

    /**
     * Modal Controller
     */
    const Modal = {
        element: document.getElementById('product-modal'),
        content: document.getElementById('product-modal-content'),

        init() {
            if (!this.element) return;
            this.element.addEventListener('close', () => this.onClose());
        },

        open(productId) {
            if (!this.element || !productId) return;

            // Lock scroll
            document.documentElement.classList.add('overflow-hidden');
            document.body.style.touchAction = 'none';

            // Show modal and ensure placeholder/spinner is visible
            this.content.innerHTML = `
                <div class="restem-spinner grid place-items-center min-h-[200px] h-full">
                    <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-[#B45309]"></div>
                </div>
            `;
            this.element.showModal();

            // Load data
            postAjax('restem_load_product_modal', { id: productId })
                .then(html => {
                    if (html) {
                        this.content.innerHTML = html;

                        // If you add new images via AJAX, run this:
                        lightbox.reload();
                    }
                });


        },

        onClose() {
            // Unlock scroll
            document.documentElement.classList.remove('overflow-hidden');
            document.body.style.touchAction = '';
            // Clear content
            this.content.innerHTML = '';
        }
    };

    /**
     * Menu Controller
     */
    const Menu = {
        init(block) {
            const productsContainer = block.querySelector('[data-menu-products]');
            const categoryButtons = block.querySelectorAll('[data-category]');

            // Category Filter Click
            categoryButtons.forEach(btn => {
                btn.addEventListener('click', async () => {
                    const category = btn.dataset.category;
                    if (state.isLoading) return;

                    state.isLoading = true;
                    this.updateUI(block, btn, category);

                    const html = await postAjax('restem_filter_menu', { category });
                    if (html) {
                        productsContainer.innerHTML = html;
                        // Re-bind modal events to new products
                        this.bindProductEvents(productsContainer);
                    }
                    state.isLoading = false;
                });
            });

            // Initial binding for products
            this.bindProductEvents(block);
        },

        updateUI(block, activeBtn, category) {
            // Update buttons state
            block.querySelectorAll('[data-category]').forEach(btn => btn.dataset.activeCategory = false);
            activeBtn.dataset.activeCategory = true;

            // Update URL & Title
            const url = new URL(window.location.href);
            url.searchParams.set('category', category);
            window.history.pushState({}, '', url);
            document.title = `Menu - ${activeBtn.textContent.trim()}`;
        },

        bindProductEvents(container) {

            container.querySelectorAll('[data-open-modal]').forEach(btn => {
                btn.onclick = () => Modal.open(btn.dataset.productId);
            });

            // If you add new images via AJAX, run this:
            lightbox.reload();
        }
    };

    // Initialize all components
    const init = () => {
        Modal.init();
        document.querySelectorAll('[data-menu-block]').forEach(block => Menu.init(block));
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
