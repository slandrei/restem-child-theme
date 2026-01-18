<?php
/**
 * Render PHP for the Menu block.
 */

$categories = get_terms( [
	'taxonomy'   => 'product_cat',
	'hide_empty' => true,
] );
?>

<div class="tw" data-menu-block>
    <div class="flex gap-3 mb-6 flex-wrap">
		<?php foreach ( $categories as $index => $cat ): ?>
            <button data-category="<?= esc_attr( $cat->slug ); ?>"
                    class="!text-gray-100 !bg-[#22211f] !border-[#22211f] data-[active-category='true']:!bg-[#b07657] data-[active-category='true']:!border-[#b07657]"
                    data-active-category="<?= ( isset( $_GET['category'] ) && $_GET['category'] === $cat->slug ) || ( ! isset( $_GET['category'] ) && $index === 0 ) ? 'true' : 'false' ?>"
            >
				<?= esc_html( $cat->name ); ?>
            </button>
		<?php endforeach; ?>
    </div>

    <div data-menu-products>
		<?php
		get_template_part(
			'template-parts/menu/products',
			null,
			[ 'category' => $categories[0]->slug ?? '' ]
		);
		?>
    </div>
</div>
