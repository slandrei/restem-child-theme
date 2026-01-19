<?php
/**
 * Template part for a single menu loop item.
 */
$product     = $args['product'];
$image_id    = $product->get_image_id();
$image_url   = wp_get_attachment_image_url( $image_id, 'medium' );
$weight      = $product->get_weight();
$description = $product->get_short_description() ?: $product->get_description();
// Truncate description if too long
$description   = wp_trim_words( $description, 20 );
$price         = $product->get_price();
$sale_price    = $product->get_sale_price();
$price         = number_format( (float) $product->get_price(), 2 );
$sale_price    = $sale_price ? number_format( (float) ( $sale_price ), 2 ) : '';
$is_vegetarian = has_term( 'vegetarian', 'product_cat', $product->get_id() );
?>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full opacity-0 animate-fade-in">
<!-- Image -->
    <div class="restem-product-image relative p-3">
        <div class="w-full overflow-hidden rounded-lg relative">
            <?php if ( $image_url ) : ?>
                <img src="<?= esc_url( $image_url ); ?>" alt="<?= esc_attr( $product->get_name() ); ?>"
                     class="w-full max-h-[280px] min-h-[280px] h-full object-cover elect-none pointer-events-none">
            <?php else : ?>
                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                    <span class="text-[#76736ccc]">Fără imagine</span>
                </div>
            <?php endif; ?>

            <!-- Icons -->
            <div class="absolute top-2 left-2">
                <?php if ( $is_vegetarian ) : ?>
                    <div class="bg-[#7BA05B] p-1.5 rounded-lg shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                <?php else: ?>
                    <!-- Placeholder leaf icon as seen in image -->
                    <div class="bg-[#7BA05B]/80 backdrop-blur-sm p-1.5 rounded-lg shadow-sm">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 12C2 12 5 2 12 2C12 2 19 2 22 5C22 5 22 12 12 12C12 12 22 12 22 19C22 19 22 22 19 22C19 22 12 22 12 12C12 12 12 22 5 22C5 22 2 22 2 19C2 19 2 12 12 12C12 12 2 12 2 5C2 5 2 2 5 2C5 2 12 2 12 12"
                                  stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>

            <div class="absolute top-2 right-2">
                <div class="bg-black/20 backdrop-blur-md p-1.5 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
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

        <h3 class="!text-[32px] !font-bold text-gray-800 mb-1 !leading-normal text-left "><?php echo esc_html( $product->get_name() ); ?></h3>

        <?php if ( $weight ) : ?>
            <span class="text-gray-500 text-md mb-3 block text-left"><?= esc_html( $weight ); ?>g</span>
        <?php endif; ?>

        <div class="!text-[#76736ccc] !text-md leading-relaxed mb-6 flex-grow text-left">
            <?= $description; ?>
            Lorem ipsum dolor sit amet, at mei dolore tritani repudiandae. In his nemore vim ad prima vivendum consetetur. Viderer feugiat at pro, mea aperiam
        </div>

        <div class="border-t border-gray-100 pt-5 flex items-center justify-between mt-auto">
            <?php if ( $price > 0 ) : ?>
                <div class="flex gap-2">
                    <div class="product-price text-[#B45309] font-bold !text-2xl leading-none [&_del]:text-[#76736ccc] [&_del]:font-normal [&_del]:text-sm [&_del]:ml-2 [&_ins]:no-underline [&_.amount]:text-[#B45309]">
                        <?= $price; ?> lei
                    </div>
                    <?php if ( $sale_price ) : ?>
                        <div class="product-old-price text-[#76736c] text-lg font-bold line-through">
                            &nbsp;<?= $sale_price; ?> lei
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <span class="text-red-700">Indisponibil</span>
            <?php endif; ?>

            <button
                    class="!text-sm !border-[1px] !bg-transparent !border-gray-800 !text-gray-800 !px-6 !py-3 rounded-xl font-medium hover:!bg-[#22211f] hover:!text-white duration-500 transition-colors"
                    data-open-modal
                    data-product-id="<?= $product->get_id(); ?>"
            >
                Detalii
            </button>
        </div>
    </div>
</div>
