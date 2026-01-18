/**
 * View JS for the Menu block.
 */
document.querySelectorAll('[data-menu-block]').forEach(block => {
    const products = block.querySelector('[data-menu-products]');
    const modal = document.getElementById('product-modal');
    const modalContent = document.getElementById('product-modal-content');

    modal.addEventListener('close', () => {
        console.log('Close the modal')
        document.documentElement.classList.remove('overflow-hidden');
        document.body.style.touchAction = '';

        // Clear modal content
        modalContent.innerHTML = '';

    });

    block.querySelectorAll('[data-category]').forEach(btn => {
        btn.addEventListener('click', () => {
            const fd = new FormData();
            fd.append('action', 'restem_filter_menu');
            fd.append('category', btn.dataset.category);

            // Update URL search params
            const url = new URL(window.location.href);
            url.searchParams.set('category', btn.dataset.category);
            window.history.pushState({}, '', url);
            // Update tab title with the selected category
            document.title = `Menu - ${btn.textContent.trim()}`;

            // Set current button data-active-category true and all others false
            block.querySelectorAll('[data-category]').forEach(btn => btn.dataset.activeCategory = false);
            btn.dataset.activeCategory = true;

            fetch(restem_utils.ajaxurl, {
                method: 'POST',
                body: fd
            })
                .then(r => r.text())
                .then(html => products.innerHTML = html);
        });
    });

    block.querySelectorAll('[data-open-modal]').forEach(btn =>
        btn.addEventListener('click', () => {
            const productId = btn.dataset.productId;

            const fd = new FormData();
            fd.append('action', 'restem_load_product_modal');
            fd.append('id', productId);


            fetch(restem_utils.ajaxurl, {
                method: 'POST',
                body: fd
            })
                .then(r => r.text())
                //.then(html => console.log(html));
                .then(html => modalContent.innerHTML = html);


            document.documentElement.classList.add('overflow-hidden');
            document.body.style.touchAction = 'none';
            modal.showModal();
        })
    );
});
