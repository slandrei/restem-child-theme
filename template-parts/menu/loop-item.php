<?php
/**
 * Template part for a single menu loop item.
 */
$product    = isset( $args['product'] ) ? $args['product'] : null;
$classNames = isset( $args['classNames'] ) ? $args['classNames'] : '';
$image_id   = $product->get_image_id();
$image_url  = wp_get_attachment_image_url( $image_id, 'large' );

?>

<div class="restem-product flex-1 bg-kubio-color-1/5 rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full opacity-0 animate-fade-in <?=$classNames?>">
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
