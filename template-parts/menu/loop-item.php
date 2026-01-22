<?php
/**
 * Template part for a single menu loop item.
 */
$product     = $args['product'];
$image_id    = $product->get_image_id();
$image_url   = wp_get_attachment_image_url( $image_id, 'large' );

?>

<div class="bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full opacity-0 animate-fade-in">
    <!-- Image -->
    <?php
    get_template_part(
            'template-parts/components/product-image',
            null,
            [ 'product' => $product ]
    );
    ?>

    <!-- Content -->
    <?php
    get_template_part(
            'template-parts/components/product-content',
            null,
            [ 'product' => $product ]
    );
    ?>
</div>
