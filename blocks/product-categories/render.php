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


<div class="tw" data-product-categories-block>
    <div class="relative grid grid-cols-5 gap-4">
<!--        --><?php
/*        get_template_part(
                'template-parts/components/product-categories',
                null
        );
        */?>
        
    <?php foreach ( $categories as $category ) : ?>
        <a href="/menu?category=<?= $category->slug ?>"
           class="flex flex-col h-fit gap-2 border-2 text-white hover:text-white">
            <div class="relative flex h-full w-full aspect-square overflow-hidden">
                <?php
                $featured_img_id = get_term_meta( $category->term_id, '_category_featured_image_id', true );
                if ( $featured_img_id ) {
                    echo wp_get_attachment_image( $featured_img_id, 'full', null, [ 'class' => 'w-full h-full object-cover' ] );
                }
                ?>
            </div>

            <span class="text-xl whitespace-wrap">
                <?= $category->name ?>
            </span>
        </a>
    <?php endforeach; 
    
    ?>
      
    </div>

</div>
