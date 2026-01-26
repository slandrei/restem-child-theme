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

<style>
    [data-menu-block] * {
        font-family: 'Mulish', 'Helvetica', 'Arial', sans-serif !important;
    }
</style>

<div class="tw" data-menu-block>
    <div class="relative">
        <div class="flex flex-col lg:flex-row justify-center lg:justify-between flex-wrap gap-3 items-center mb-10 px-4 md:px-5 lg:px-10">
            <div>
                <h2 class="!text-[3.5rem] !leading-none !font-semibold text-center lg:text-left !m-0 !mb-1">Meniul zilei</h2>
                <div class="flex flex-wrap text-kubio-color-6/50 justify-center ld:justify-start">
                    <strong>Disponibil luni – vineri, între 12:00 – 16:00.</strong>
                    În limita stocului zilnic.
                </div>
            </div>
            <button class="!text-[1.5rem] lg:!text-[2rem] !font-bold !rounded-lg"><?= $price ?> lei</button>
        </div>

        <div data-menu-products class="">
            <?php
            get_template_part(
                    'template-parts/daily-menu/products',
                    null,
                    [
                            'products' => $products
                    ]
            );
            ?>
        </div>
    </div>

</div>
