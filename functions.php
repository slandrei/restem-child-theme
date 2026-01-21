<?php

add_action( 'wp_enqueue_scripts', function () {
	// Register ajaxurl for frontend scripts
	wp_localize_script( 'restaurant-menu-view-script', 'restem_utils', [
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	] );

	// Enqueue Alpine.js
	restem_enqueue_alpine_js();

	// Enqueue GLightbox - https://github.com/biati-digital/glightbox
	restem_enqueue_glightbox();

}, 100 );

function restem_enqueue_glightbox() {
	// Enqueue glightbox CSS - TODO: wp_enqueue_style does not work correctly
	/*	wp_enqueue_style(
			'glightbox-css',
			get_stylesheet_directory_uri() . '/assets/css/glightbox.min.css',
			array(), // dependencies
			'3.2.0' // version number - helps with cache busting
		);*/

	// Enqueue glightbox JS
	wp_enqueue_script(
		'glightbox-js',
		get_stylesheet_directory_uri() . '/assets/js/glightbox.min.js',
		array(),
		'3.2.0', // version number
		true
	);

	// Initialize the lightbox
	wp_add_inline_script( 'glightbox-js',"const lightbox = GLightbox({ selector: '.glightbox', loop: false, touchNavigation: false, keyboardNavigation: false });" );
}

function restem_enqueue_alpine_js() {
	wp_enqueue_script(
		'alpine-js',
		get_stylesheet_directory_uri() . '/assets/js/alpine.min.js',
		array(),
		'3.x.x',
		array( 'strategy' => 'defer' )
	);
}

// Register Menu block
add_action( 'init', function () {
	register_block_type( __DIR__ . '/blocks/menu' );
} );

add_action( 'wp_head', function () {
	/*
	$reset_file = get_stylesheet_directory_uri() . '/assets/css/reset.css';
	if($reset_file) {
		$reset_uri = get_stylesheet_directory_uri() . '/assets/css/reset.css';
		echo '<link rel="stylesheet" href="' . esc_url($reset_uri) . '" />';
	}
	*/

	$css_file = get_stylesheet_directory() . '/assets/css/glightbox.min.css';
	if ( file_exists( $css_file ) ) {
		$css_url = get_stylesheet_directory_uri() . '/assets/css/glightbox.min.css';
		echo '<link rel="stylesheet" href="' . esc_url( $css_url ) . '" />';
	}

	$css_file = get_stylesheet_directory() . '/assets/css/output.css';
	if ( file_exists( $css_file ) ) {
		$css_url = get_stylesheet_directory_uri() . '/assets/css/output.css';
		echo '<link rel="stylesheet" href="' . esc_url( $css_url ) . '" />';
	}

} );

// Modal Product
add_action( 'wp_footer', function () {
	get_template_part( 'template-parts/menu/modal-product', null );
} );


// Ajax functions
require_once get_stylesheet_directory() . '/inc/ajax.php';
