<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once __DIR__ . '/lib/constants.php';
require_once __DIR__ . '/lib/auto-generated-kubio-theme.php';
// Ajax functions
require_once get_stylesheet_directory() . '/inc/ajax.php';
require_once get_stylesheet_directory() . '/inc/product-category-image-field.php';

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

add_action( 'admin_enqueue_scripts', function () {
	restem_enqueue_custom_admin_scripts();
}, 20 );

function restem_enqueue_custom_admin_scripts() {
	$files = [
		'/assets/js/admin/product-category-image-field.js',
	];
	foreach ( $files as $path ) {
		$full_path = get_stylesheet_directory() . $path;
		$name      = "restem-admin-" . basename( $full_path );
		if ( file_exists( $full_path ) ) {
			wp_enqueue_script( $name, get_stylesheet_directory_uri() . $path, array(), filemtime( $full_path ), true );
		}
	}
}

function restem_enqueue_custom_scripts() {
	$files = [
		'/assets/js/index.js',
	];

	foreach ( $files as $path ) {
		$full_path = get_stylesheet_directory() . $path;
		$name      = "restem-" . basename( $full_path );
		if ( file_exists( $full_path ) ) {
			wp_enqueue_script( $name, get_stylesheet_directory_uri() . $path, array(), filemtime( $full_path ), true );
		}
	}
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

// Register Blocks
add_action( 'init', function () {
	// 1. Static blocks (legacy)
	$legacy_blocks = [ 'menu', 'daily-menu', 'product-categories' ];
	foreach ( $legacy_blocks as $block ) {
		$dir = __DIR__ . '/blocks/' . $block;
		if ( is_dir( $dir ) && file_exists( $dir . '/block.json' ) ) {
			register_block_type( $dir );
		}
	}

	// 2. Dynamic blocks (built from src/blocks)
	$build_blocks_dir = __DIR__ . '/build/blocks';
	if ( is_dir( $build_blocks_dir ) ) {
		$folders = array_diff( scandir( $build_blocks_dir ), array( '..', '.' ) );
		foreach ( $folders as $folder ) {
			$block_path = $build_blocks_dir . '/' . $folder;
			if ( is_dir( $block_path ) && file_exists( $block_path . '/block.json' ) ) {
				register_block_type( $block_path );
			}
		}
	}
} );

// Modal Product
add_action( 'wp_footer', function () {
	get_template_part( 'template-parts/menu/modal-product', null );
} );

add_action( 'after_setup_theme', function () {
	// 1. Enable support for editor styles
	add_theme_support( 'editor-styles' );

	// 2. Point to your compiled Tailwind file (relative to theme root)
	$tailwind_generated_css = 'assets/css/output.css';
	if ( defined( 'RESTEM_PRODUCTION' ) && RESTEM_PRODUCTION === 'true' ) {
		$tailwind_generated_css = '/assets/css/minified/output.min.css';
	}

	add_editor_style( $tailwind_generated_css );
} );


add_action( 'enqueue_block_editor_assets', function () {
	// 1. Determine the correct path
	$tailwind_generated_css = '/assets/css/output.css';
	if ( defined( 'RESTEM_PRODUCTION' ) && RESTEM_PRODUCTION === 'true' ) {
		$tailwind_generated_css = '/assets/css/minified/output.min.css';
	}

	$full_path = get_stylesheet_directory() . $tailwind_generated_css;
	$url = get_stylesheet_directory_uri() . $tailwind_generated_css;

	// 2. Enqueue the style specifically for the editor UI (Sidebar + Toolbars)
	if ( file_exists( $full_path ) ) {
		wp_enqueue_style(
			'restem-tailwind-sidebar',
			$url,
			array(),
			filemtime( $full_path ) // Cache busting
		);
	}
} );

