<?php

/** @var $args */

$products = isset( $args['products'] ) ? $args['products'] : null;
$price    = isset( $args['price'] ) ? $args['price'] : null;
if ( ! $products ) {
    return;
}

?>

<div class="restem-daily-menu-block flex flex-col gap-0">
    <div class="bg-kubio-color-1">This is a test color</div>

    <h1 class="'!leading-normal !text-6.5xl !font-medium !m-0 !mb-1 text-center px-4">Meniul zilei - <?= $price ?> lei</h1>
    <div class="text-center mb-10 text-[#22211f80] px-4">
        <strong class="!text-test">Disponibil luni – vineri, între 12:00 – 16:00.</strong>
        În limita stocului zilnic.
    </div>
    <div class="restem-daily-menu-products grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:flex-row justify-center items-center gap-4 px-4 md:px-5 lg:px-10">
        <?php
        foreach ( $products as $product ) {
            get_template_part(
                    'template-parts/menu/loop-item',
                    null,
                    [ 'product' => $product ]
            );
        }
        ?>
    </div>
</div>


