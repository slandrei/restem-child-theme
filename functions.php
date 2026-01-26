<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once __DIR__ . '/lib/constants.php';
require_once __DIR__ . '/lib/auto-generated-kubio-theme.php';
// Ajax functions
require_once get_stylesheet_directory() . '/inc/ajax.php';

add_action( 'wp_head', function () {
	$files = [
		'/assets/css/minified/glightbox.min.css',
		'/assets/css/minified/tippy.min.css',
		'/assets/css/minified/backdrop.min.css', // addon for tippy backdrop styling
	];

	if ( defined( 'RESTEM_PRODUCTION' ) && RESTEM_PRODUCTION === 'true' ) {
		$files[] = '/assets/css/minified/output.min.css';
	} else {
		$files[] = '/assets/css/output.css';
	}

	foreach ( $files as $path ) {
		$full_path = get_stylesheet_directory() . $path;
		$name      = "restem-" . basename( $full_path );

		if ( file_exists( $full_path ) ) {
			// Append the last modified timestamp as a version
			$version = filemtime( $full_path );
			$url     = get_stylesheet_directory_uri() . $path . '?v=' . $version;
			echo '<link rel="stylesheet" id="' . $name . '" href="' . esc_url( $url ) . '" />' . PHP_EOL;
		}
	}
} );

add_action( 'wp_enqueue_scripts', function () {
	// Register ajaxurl for frontend scripts
	wp_localize_script( 'restaurant-menu-view-script', 'restem_utils', [
		'nonce'   => wp_create_nonce( 'restem_ajax_nonce' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	] );

	// Enqueue Alpine.js
	restem_enqueue_alpine_js();

	// Enqueue GLightbox - https://github.com/biati-digital/glightbox
	restem_enqueue_glightbox();

	// Enqueue Tippy.js - https://atomiks.github.io/tippyjs/v6/all-props/
	restem_enqueue_tippy_js();

	// At the end of wp_enqueue_scripts
	restem_enqueue_custom_scripts();

}, 20 );

function restem_enqueue_custom_scripts() {
	$index_path = get_stylesheet_directory() . '/assets/js/index.js';

	wp_enqueue_script(
		'restem-index-js',
		get_stylesheet_directory_uri() . '/assets/js/index.js',
		array(),
		filemtime( $index_path ), // version number
		true
	);
}

function restem_enqueue_glightbox() {
	// Enqueue glightbox CSS - TODO: wp_enqueue_style does not work correctly
	/*	wp_enqueue_style(
			'glightbox-css',
			get_stylesheet_directory_uri() . '/assets/css/minified/glightbox.min.css',
			array(), // dependencies
			'3.2.0' // version number - helps with cache busting
		);*/

	// Enqueue glightbox JS
	wp_enqueue_script(
		'glightbox-js',
		get_stylesheet_directory_uri() . '/assets/js/minified/glightbox.min.js',
		array(),
		'3.2.0', // version number
		true
	);

	// Initialize the lightbox
	wp_add_inline_script( 'glightbox-js', "const lightbox = GLightbox({ selector: '.glightbox', loop: false, touchNavigation: false, keyboardNavigation: false });" );
}

function restem_enqueue_alpine_js() {
	wp_enqueue_script(
		'alpine-js',
		get_stylesheet_directory_uri() . '/assets/js/minified/alpine.min.js',
		array(),
		'3.x.x',
		array( 'strategy' => 'defer' )
	);
}

function restem_enqueue_tippy_js() {

	// enqueue popper.js - Tippy is based on Popper - REQUIRED
	wp_enqueue_script(
		'popper-js',
		get_stylesheet_directory_uri() . '/assets/js/minified/popper.min.js',
		array(),
		'2.x.x',
	);

	wp_enqueue_script(
		'tippy-js',
		get_stylesheet_directory_uri() . '/assets/js/minified/tippy-bundle.umd.min.js',
		array(),
		'6.x.x',
	);
}

// Register Menu block
add_action( 'init', function () {
	$block_list = [ 'menu', 'daily-menu' ];

	foreach ( $block_list as $block ) {
		register_block_type( __DIR__ . '/blocks/' . $block );
	}
} );

// Modal Product
add_action( 'wp_footer', function () {
	get_template_part( 'template-parts/menu/modal-product', null );
} );

