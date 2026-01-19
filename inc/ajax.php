<?php
/**
 * AJAX handlers for the theme.
 */

add_action( 'wp_ajax_restem_filter_menu', 'restem_filter_menu' );
add_action( 'wp_ajax_nopriv_restem_filter_menu', 'restem_filter_menu' );
function restem_filter_menu() {
	ob_start();
	get_template_part(
		'template-parts/menu/products',
		null,
		[ 'category' => $_POST['category'] ]
	);
	echo ob_get_clean();
	wp_die();
}


add_action( 'wp_ajax_restem_load_product_modal', 'restem_load_product_modal' );
add_action( 'wp_ajax_nopriv_restem_load_product_modal', 'restem_load_product_modal' );
function restem_load_product_modal() {
	$product_id = absint( $_POST['id'] );

	if ( ! $product_id ) {
		wp_die();
	}

	$product = wc_get_product( $product_id );

	if ( ! $product || ! $product instanceof WC_Product ) {
		wp_die();
	}

    get_template_part( 'template-parts/menu/product-content-in-modal', null, [ 'product' => $product ] );

	wp_die();
}

