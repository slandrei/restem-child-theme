<?php

$product       = $args['product'];
$image_id      = $product->get_image_id();
$image_url     = wp_get_attachment_image_url( $image_id, 'large' );
$weight        = $product->get_weight();
$description   = $product->get_description();
$price         = $product->get_price();
$sale_price    = $product->get_sale_price();
$price         = number_format( (float) $product->get_price(), 2 );
$sale_price    = $sale_price ? number_format( (float) ( $sale_price ), 2 ) : '';
$is_vegetarian = has_term( 'vegetarian', 'product_cat', $product->get_id() );

// Mocking nutrition and allergens as they are usually custom fields
// In a real scenario, these would be get_post_meta($product_id, '...', true)
$nutrition_text = "Valorile nutriționale sunt orientative și pot varia în funcție de ingredientele folosite. Preparatul este gătit proaspăt, la comandă.";
$gramaje        = "Chiflă burger: 80 g, Chiftea vegetariană (năut & legume): 120 g, Salată verde: 20 g, Roșii: 30 g, Ceapă caramelizată: 25 g, Sos special: 30 g, Cartofi wedges: 150 g, Gramaj total: ~455 g";
$valori_nutri   = "Energie: 520 kcal, Proteine: 18 g, Carbohidrați: 62 g, Grăsimi: 24 g, Fibre: 9 g, Sare: 1.6 g";
$alergeni       = "Gluten, Muștar (sos), Susan (posibil, în chiflă)";
?>

<div class="tw flex flex-col h-full overflow-hidden min-h-0 max-h-[calc(90vh-40px)] md:max-h-[90vh] opacity-0 animate-fade-in duration-300 ease-in-out">
<!-- Zona scrollabila: Imagine + Conținut -->
    <div class="relative flex-1 overflow-y-auto min-h-0"
         style="scrollbar-width: none; -ms-overflow-style: none; height: calc(90vh - 120px);">
    <style>
            .overflow-y-auto::-webkit-scrollbar {
                display: none;
            }

            .transition-[height] {
                transition-property: height;
            }

            .duration-300 {
                transition-duration: 500ms;
            }

            .ease-in-out {
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            }
        </style>
        <!-- Imagine -->
        <div class="relative p-4 pb-0">
            <div class="aspect-[4/3] w-full overflow-hidden rounded-xl relative shadow-inner bg-gray-50">
				<?php if ( $image_url ) : ?>
                    <img src="<?= esc_url( $image_url ); ?>" alt="<?= esc_attr( $product->get_name() ); ?>"
                         class="w-full h-full object-cover">
				<?php else : ?>
                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
				<?php endif; ?>

                <!-- Iconiță Vegetarian -->
				<?php if ( $is_vegetarian ) : ?>
                    <div class="absolute top-4 left-4 bg-[#7BA05B]/90 backdrop-blur-sm p-2 rounded-xl shadow-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 12C2 12 5 2 12 2C12 2 19 2 22 5C22 5 22 12 12 12C12 12 22 12 22 19C22 19 22 22 19 22C19 22 12 22 12 12C12 12 12 22 5 22C5 22 2 22 2 19C2 19 2 12 12 12C12 12 2 12 2 5C2 5 2 2 5 2C5 2 12 2 12 12"
                                  stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
				<?php endif; ?>
            </div>
        </div>

        <style>
            .restem-product-content * {
                font-family: 'Mulish', 'Helvetica', 'Arial', sans-serif !important;
            }
        </style>

        <!-- Conținut -->
        <div class="restem-product-content px-8 pt-6 pb-8 overflow-y-auto">
        <h2 class="!text-3xl !font-bold text-gray-900 mb-1 !leading-normal"><?= esc_html( $product->get_name() ); ?></h2>
			<?php if ( $weight ) : ?>
                <div class="!text-base text-gray-500 font-medium mb-4"><?= esc_html( $weight ); ?>g</div>
			<?php endif; ?>

            <div class="text-gray-700 leading-relaxed mb-6 text-lg">
				<?= wp_kses_post( $description ); ?>
            </div>

            <div class="border-t border-gray-100 my-6"></div>

            <div class="space-y-6">
                <p class="text-[#b07657] text-sm leading-relaxed italic">
					<?= esc_html( $nutrition_text ); ?>
                </p>

                <div class="flex gap-4">
                    <div class="mt-1 flex-shrink-0">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                        </svg>
                    </div>
                    <div class="text-sm text-gray-600 leading-relaxed">
                        <strong class="text-gray-800">Gramaje detaliate:</strong> <?= esc_html( $gramaje ); ?>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="mt-1 flex-shrink-0">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <div class="text-sm text-gray-600 leading-relaxed">
                        <strong class="text-gray-800">Valori nutriționale (per porție –
                            aproximativ):</strong> <?= esc_html( $valori_nutri ); ?>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="mt-1 flex-shrink-0">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="text-sm text-gray-600 leading-relaxed">
                        <strong class="text-gray-800">Alergeni:</strong> <?= esc_html( $alergeni ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer cu Preț și Buton -->
    <div class="mt-auto border-t border-gray-100 p-8 pt-6">
        <div class="flex items-center justify-between">
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

          <!--  <a href="<?php /*= esc_url( $product->add_to_cart_url() ); */?>"
               class="bg-gray-900 text-white px-8 py-3 rounded-2xl text-lg font-bold hover:bg-black transition-transform active:scale-95 shadow-lg">
                Adaugă
            </a>-->
        </div>
    </div>
</div>
