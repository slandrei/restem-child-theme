<?php
/**
 * Template part for a single menu loop item.
 */
$product = $args['product'];
$image_id = $product->get_image_id();
$image_url = wp_get_attachment_image_url($image_id, 'medium');
$weight = $product->get_weight();
$description = $product->get_short_description() ?: $product->get_description();
// Truncate description if too long
$description = wp_trim_words($description, 20);
$price_html = $product->get_price_html();
$is_vegetarian = has_term('vegetarian', 'product_cat', $product->get_id());
?>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full font-sans">
    <!-- Imaginea produsului -->
    <div class="relative p-3">
        <div class="w-full overflow-hidden rounded-2xl relative">
            <?php if ($image_url) : ?>
                <img src="<?= esc_url($image_url); ?>" alt="<?= esc_attr($product->get_name()); ?>" class="w-full max-h-[280px] h-full object-cover">
            <?php else : ?>
                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                    <span class="text-gray-400">Fără imagine</span>
                </div>
            <?php endif; ?>

            <!-- Iconițe suprapuse -->
            <div class="absolute top-2 left-2">
                <?php if ($is_vegetarian) : ?>
                    <div class="bg-[#7BA05B] p-1.5 rounded-lg shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                <?php else: ?>
                    <!-- Placeholder leaf icon as seen in image -->
                    <div class="bg-[#7BA05B]/80 backdrop-blur-sm p-1.5 rounded-lg shadow-sm">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 12C2 12 5 2 12 2C12 2 19 2 22 5C22 5 22 12 12 12C12 12 22 12 22 19C22 19 22 22 19 22C19 22 12 22 12 12C12 12 12 22 5 22C5 22 2 22 2 19C2 19 2 12 12 12C12 12 2 12 2 5C2 5 2 2 5 2C5 2 12 2 12 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>

            <div class="absolute top-2 right-2">
                <div class="bg-black/20 backdrop-blur-md p-1.5 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Conținut text -->
    <div class="px-5 pb-5 flex flex-col flex-grow">
        <h3 class="text-2xl font-bold text-gray-800 mb-1 leading-tight"><?= esc_html($product->get_name()); ?></h3>
        
        <?php if ($weight) : ?>
            <span class="text-gray-500 text-sm mb-3 block"><?= esc_html($weight); ?>g</span>
        <?php endif; ?>

        <div class="text-gray-400 text-sm leading-relaxed mb-6 flex-grow">
            <?= $description; ?>
        </div>

        <div class="border-t border-gray-100 pt-5 flex items-center justify-between mt-auto">
            <div class="flex flex-col">
                <div class="product-price text-[#B45309] font-bold text-xl leading-none [&_del]:text-gray-400 [&_del]:font-normal [&_del]:text-sm [&_del]:ml-2 [&_ins]:no-underline [&_.amount]:text-[#B45309]">
                    <?= $price_html; ?>
                </div>
            </div>
            
            <a href="<?= esc_url($product->get_permalink()); ?>" class="border border-gray-800 text-gray-800 px-6 py-2 rounded-xl text-sm font-medium hover:bg-gray-800 hover:text-white transition-colors">
                Detalii
            </a>
        </div>
    </div>
</div>
