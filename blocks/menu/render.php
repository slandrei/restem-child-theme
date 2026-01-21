<?php
/**
 * Render PHP for the Menu block.
 */

$categories = get_terms( [
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
] );
?>

<script>
    function restemStickyCategories() {
        return {
            scrolled: false,

            handleScroll() {
                const element = document.querySelector('.restem-product-categories');
                const rect = element.getBoundingClientRect();

                this.scrolled = rect.top === 0;
            }
        }
    }

</script>

<div class="tw" data-menu-block>
    <div id="sticky-sentinel" class="absolute -top-2.5"></div>

    <div class="bg-[#AF9C91]/20 py-[90px] ">
        <div
                x-data="restemStickyCategories()"
                @scroll.window="handleScroll()"
                class="restem-product-categories  sticky top-0 z-10 flex gap-3 overflow-x-auto md:flex-wrap justify-start md:justify-center px-4 md:px-5 lg:px-6 py-2 "
                :class="{ 'bg-white backdrop-blur-md justify-start shadow-sm': scrolled }"
        >
            <?php foreach ( $categories as $index => $cat ): ?>
                <button data-category="<?php echo esc_attr( $cat->slug ); ?>"
                        class="!text-gray-100 md:!text-lg !font-bold !bg-[#22211f] !border-[#22211f] data-[active-category='true']:!bg-[#b07657] data-[active-category='true']:!border-[#b07657] !px-8 !py-4"
                        data-active-category="<?= ( isset( $_GET['category'] ) && $_GET['category'] === $cat->slug ) || ( ! isset( $_GET['category'] ) && $index === 0 ) ? 'true' : 'false' ?>"
                >
                    <?= esc_html( $cat->name ); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div data-menu-products class="">
            <?php
            get_template_part(
                    'template-parts/menu/products',
                    null,
                    [ 'category' => $categories[0]->slug ?? '' ]
            );
            ?>
        </div>
    </div>

</div>
