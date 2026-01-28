<?php
/** @var array $attributes */

$selected_categories = isset( $attributes['selectedCategories'] ) ? $attributes['selectedCategories'] : [];

$args = [
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
];

if ( ! empty( $selected_categories ) ) {
    $args['include'] = $selected_categories;
    $args['orderby'] = 'include';
}

$categories = get_terms( $args );
?>

<div class="tw" data-product-categories-block>
    <div class="relative flex flex-wrap gap-2.5 gap-y-4 md:gap-0">
        <?php foreach ( $categories as $category ) : ?>
            <a href="/menu<?= $category->count > 0 ? '?category=' . $category->slug : '' ?>"
               class="flex-1 flex flex-col h-fit gap-2 text-white hover:text-white">
                <div class="relative flex h-full w-full ">
                    <div class="restem-category-wrapper flex justify-center w-full min-w-[70px] h-[70px] overflow-hidden">
                        <?php
                        $featured_img_id = get_term_meta( $category->term_id, '_category_featured_image_id', true );
                        if ( $featured_img_id ) {
                            echo wp_get_attachment_image( $featured_img_id, 'full', null, [ 'class' => 'w-[70px] h-[70px] object-cover' ] );
                        } else {
                            echo '<img src="https://placehold.co/100" alt="placeholder" class="w-[70px] h-[70px]" />';
                        }
                        ?>
                    </div>

                </div>

                <span class="text-sm font-semibold text-kubio-color-6-variant-1 whitespace-wrap uppercase">
                    <?= $category->name ?>
                </span>
            </a>
        <?php endforeach; ?>
    </div>
</div>
