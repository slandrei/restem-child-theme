<?php
/** @var $args */

$product     = $args['product'];
$weight      = $product->get_weight();
$description = $product->get_short_description() ?: $product->get_description();
// Truncate description if too long
//$description   = wp_trim_words( $description, 30 );
$price         = $product->get_regular_price();
$sale_price    = $product->get_sale_price();
$price         = number_format( (float) $product->get_regular_price(), 2 );
$sale_price    = $sale_price !== "" ? number_format( (float) ( $sale_price ), 2 ) : 0;

?>


<style>
    .restem-product-content * {
        font-family: 'Mulish', 'Helvetica', 'Arial', sans-serif !important;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-in forwards;
    }
</style>
<div class="restem-product-content antialiased px-5 pb-5 flex flex-col flex-grow">

    <h3 class="!text-[24px] md:!text-[28px] !font-bold text-kubio-color-1-variant-5 mb-1 !leading-normal text-left ">
		<?php echo esc_html( $product->get_name() ); ?>
    </h3>

	<?php if ( $weight ) : ?>
        <span class="text-gray-500 text-md mb-3.75 block text-left"><?= esc_html( $weight ); ?>g</span>
	<?php endif; ?>

    <div class="!text-kubio-color-6-variant-2/80 !text-md leading-[1.4] mb-3.75 md:mb-5 flex-grow text-left overflow-hidden"
         style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
		<?= $description; ?>
    </div>

    <div class="border-t border-gray-100 pt-3.75 md:pt-5 flex items-center justify-between mt-auto">
		<?php if ( $price > 0 ) : ?>
            <div class="flex flex-wrap gap-x-2 gap-y-0">
                <div class="product-price text-kubio-color-1 font-bold !text-2xl leading-none [&_del]:text-kubio-color-6-variant-2/80 [&_del]:font-normal [&_del]:text-sm [&_del]:ml-2 [&_ins]:no-underline [&_.amount]:text-kubio-color-1">
					<?= $sale_price > 0 && $sale_price < $price ? $sale_price : $price; ?> lei
                </div>
				<?php if ($sale_price > 0 && $sale_price < $price ) : ?>
                    <div class="product-old-price text-kubio-color-6-variant-2 text-lg line-through">
                        &nbsp;<?= $price; ?> lei
                    </div>
				<?php endif; ?>
            </div>
		<?php else: ?>
            <span class="text-red-700">Indisponibil</span>
		<?php endif; ?>

        <button
                class="!text-sm !border-[1px] !bg-transparent !border-gray-800 !text-gray-800 !px-6 !py-3 rounded-xl font-medium hover:!bg-kubio-color-6/12 duration-500 transition-colors"
                data-open-modal
                data-product-id="<?= $product->get_id(); ?>"
        >
            Detalii
        </button>
    </div>
</div>
