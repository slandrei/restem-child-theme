<?php
// Check URL parameter first, fallback to args
$category = isset( $_GET['category'] ) ? sanitize_text_field( $_GET['category'] ) : ( $args['category'] ?? '' );

$args = [
	'status'   => 'publish',
	'limit'    => - 1,
	'category' => $category ? [ $category ] : []
];

$query    = new WC_Product_Query( $args );
$products = $query->get_products();

echo '<div class="restem-products grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">';

foreach ( $products as $product ) {
	get_template_part(
		'template-parts/menu/loop-item',
		null,
		[ 'product' => $product ]
	);
}

echo '</div>';
