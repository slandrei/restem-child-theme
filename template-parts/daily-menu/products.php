<?php

/** @var $args */

$products = isset( $args['products'] ) ? $args['products'] : null;

if ( ! $products ) {
    return;
}

?>

<div class="restem-daily-menu-block flex flex-col gap-0">
    <div class="restem-daily-menu-products grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:flex-row justify-center items-center gap-4 px-4 md:px-5 lg:px-10">
        <?php
        foreach ( $products as $product ) {
            get_template_part(
                    'template-parts/menu/loop-item',
                    null,
                    [
                            'product'    => $product,
                            "classNames" => "bg-white"
                    ]
            );
        }
        ?>
    </div>
</div>


