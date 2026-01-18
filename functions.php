<?php

add_action('wp_enqueue_scripts', function () {
	// Register ajaxurl for frontend scripts
	wp_localize_script( 'restaurant-menu-view-script', 'restem_utils', [
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	] );
}, 100);



add_action('init', function () {
	register_block_type(__DIR__ . '/blocks/menu');
});

add_action( 'wp_head', function () {
	echo '<!-- tailwind test -->';
});
add_action('wp_head', function() {
	/*
	$reset_file = get_stylesheet_directory_uri() . '/assets/css/reset.css';
	if($reset_file) {
		$reset_uri = get_stylesheet_directory_uri() . '/assets/css/reset.css';
		echo '<link rel="stylesheet" href="' . esc_url($reset_uri) . '" />';
	}
	*/

	$css_file = get_stylesheet_directory() . '/assets/css/output.css';
	if (file_exists($css_file)) {
		$css_url = get_stylesheet_directory_uri() . '/assets/css/output.css';
		echo '<link rel="stylesheet" href="' . esc_url($css_url) . '" />';
	}

});

add_action( 'wp_footer', function () {
	get_template_part( 'template-parts/menu/modal-product', null );
} );


require_once get_stylesheet_directory() . '/inc/ajax.php';
