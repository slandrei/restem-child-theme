<?php
/**
 * AJAX handlers for the theme.
 */

add_action( 'wp_ajax_filter_menu', 'restem_filter_menu' );
add_action( 'wp_ajax_nopriv_filter_menu', 'restem_filter_menu' );

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
