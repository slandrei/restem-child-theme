<?php
/**
 * Render PHP for the Menu block.
 */

$settings      = pods( 'meniul_zilei' );
$product_posts = $settings->field( 'daily_menu_products' );
$price         = $settings->field( 'pret' );

// Get product IDs from posts array
$product_ids = [];
if ( ! empty( $product_posts ) ) {
    foreach ( $product_posts as $post ) {
        $product_ids[] = $post['ID'];
    }
}

// Query WooCommerce products
$queryArgs = [
        'status'  => 'publish',
        'limit'   => - 1,
        'include' => $product_ids,
];

$query    = new WC_Product_Query( $queryArgs );
$products = $query->get_products();

?>

<div class="tw" data-menu-block>
    <div class="relative">
        <div data-menu-products class="">
            <?php
            get_template_part(
                    'template-parts/daily-menu/products',
                    null,
                    [
                            'price'    => $price,
                            'products' => $products
                    ]
            );
            ?>
        </div>
    </div>

</div>
