<?php
/** @var $args */

$product          = $args['product'];
$disable_lightbox = isset( $args['disable_lightbox'] ) ? $args['disable_lightbox'] : false;
$image_id         = $product->get_image_id();
$image_url        = wp_get_attachment_image_url( $image_id, 'large' );
$is_vegetarian    = has_term( 'vegetarian', 'product_cat', $product->get_id() );

if ( ! $image_url ) {
    // get the file from assets/images/placeholder.jpg
    $image_url = get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg';
    $image_url  = 'https://picsum.photos/1200/500.webp?random=' . rand( 1, 1000 ) . '';
}

?>


<div class="restem-product-image relative p-3 <?= $disable_lightbox ? 'pt-0' : '' ?>">
    <div class="w-full overflow-hidden rounded-lg relative opacity-0 animate-fade-in duration-500">
        <?php if ( $image_url ) : ?>
            <img src="<?= esc_url( $image_url ); ?>" alt="<?= esc_attr( $product->get_name() ); ?>"
                 class="<?= $disable_lightbox ? '' : 'glightbox' ?> w-full max-h-[230px] md:max-h-[280px] min-h-[230px] md:min-h-[280px] h-full object-cover"
                 data-gallery="gallery-product-<?= $product->get_id(); ?>"
            >
        <?php else : ?>
            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                <span class="text-kubio-color-6-variant-2/80">Fără imagine</span>
            </div>
        <?php endif; ?>

        <!-- Is vegetarian Icons -->
        <?php
        get_template_part(
                'template-parts/components/product-icons',
                null,
                [ 'is_vegetarian' => $is_vegetarian ]
        );
        ?>

        <?php if ( ! $disable_lightbox ) : ?>
            <div class="absolute top-2 right-2">
                <div class="bg-black/20 backdrop-blur-md p-1.5 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
