<?php
/**
 * Render PHP for the Menu block.
 */


?>



<div class="tw" data-menu-block>
    <div class="relative bg-kubio-color-1-variant-1/20 py-[90px]">
        <?php
        get_template_part(
                'template-parts/components/product-categories',
                null
        );
        ?>

        <div data-menu-products class="">
            <?php
            get_template_part(
                    'template-parts/menu/products',
                    null,
                    [ 'category' => $categories[0]->slug ?? '' ]
            );
            ?>
        </div>
    </div>

</div>
