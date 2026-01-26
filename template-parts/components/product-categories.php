<?php
/** @var $args */

$categories = isset( $args['categories'] ) ? $args['categories'] : null;

if ( ! $categories ) {
    $categories = get_terms( [
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
    ] );
}


?>

<script>
    function restemStickyCategories() {
        return {
            scrolled: false,

            handleScroll() {
                const element = document.querySelector('.restem-product-categories');
                const rect = element.getBoundingClientRect();

                this.scrolled = rect.top <= 0;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // scroll on x axis the button with the data active category to be visible on its container
        const activeCategory = document.querySelector('[data-active-category="true"]');

        if (activeCategory) {
            const container = activeCategory.parentElement;

            // Calculate the position:
            // (Item's left offset) - (Container's width / 2) + (Item's width / 2)
            // This math centers the active item within the scrollable area.
            const scrollOffset = activeCategory.offsetLeft - (container.clientWidth / 2) + (activeCategory.clientWidth / 2);

            // Set the horizontal scroll instantly so the user doesn't see a "jump"
            container.scrollTo({
                left: scrollOffset,
                behavior: 'auto'
            });
        }

    })
</script>

<style>


</style>

<div id="sticky-sentinel" class="absolute top-10 lg:top-14"></div>

<div
        x-data="restemStickyCategories()"
        x-init="handleScroll()"
        @scroll.window="handleScroll()"
        class="restem-product-categories sticky top-0 scrollbar-hide z-10 flex gap-3 overflow-x-auto lg:flex-wrap justify-start lg:justify-center px-2 md:px-5 lg:px-6 py-2 "
        :class="{ 'bg-white backdrop-blur-md justify-start shadow-sm': scrolled }"
>

    <?php
    $index = 0;
    foreach ( $categories as $cat ): ?>
        <button data-category="<?php echo esc_attr( $cat->slug ); ?>"
                class="!text-gray-100 whitespace-nowrap md:!text-lg !font-bold !bg-kubio-color-6 !border-kubio-color-6 data-[active-category='true']:!bg-kubio-color-1-variant-2 data-[active-category='true']:!border-kubio-color-1-variant-2 active:scale-95 md:active:scale-100 transition-all duration-75 md:!px-8 md:!py-4"
                data-active-category="<?= ( isset( $_GET['category'] ) && $_GET['category'] === $cat->slug ) || ( ! isset( $_GET['category'] ) && $index === 0 ) ? 'true' : 'false' ?>"
        >
            <?= esc_html( $cat->name ); ?>
        </button>
        <?php
        $index ++;
    endforeach; ?>
</div>
