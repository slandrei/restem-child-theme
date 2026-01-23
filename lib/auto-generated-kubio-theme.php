<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Core function to generate the Kubio Tailwind CSS file
 */
function sync_kubio_tailwind_vars() {
	// 1. Find the kubio-globals post
	global $wpdb;

	$query = $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = %s LIMIT 1", 'kubio-globals');
	$result = $wpdb->get_results($query);
	$post = $result[0];

	if (!$post) return;

	$file_path = get_stylesheet_directory() . '/assets/css/kubio-vars.css';

	// 2. Check if file exists OR if post was modified after the file was created
	$file_exists = file_exists($file_path);
	$post_modified_time = mysql2date('U', $post->post_modified);
	$file_modified_time = $file_exists ? filemtime($file_path) : 0;

	if (!$file_exists || $post_modified_time > $file_modified_time) {
		$data = json_decode($post->post_content, true);
		if (!$data) return;

		$css_output = "/* Auto-generated from Kubio Globals - " . date('Y-m-d H:i:s') . " */\n";
		$css_output .= "@theme {\n";

		// Helper to process the JSON structure you provided
		$process = function($color_list) use (&$css_output) {
			if (!is_array($color_list)) return;
			foreach ($color_list as $item) {
				if (isset($item['slug'], $item['color']) && is_array($item['color'])) {
					$rgb = implode(', ', $item['color']);
					$css_output .= "  --color-{$item['slug']}: rgb({$rgb});\n";
				}
			}
		};

		if (isset($data['colors'])) $process($data['colors']);
		if (isset($data['colorVariants'])) $process($data['colorVariants']);

		$css_output .= "}\n";

		// 3. Ensure directory and write file
		if (!file_exists(dirname($file_path))) {
			mkdir(dirname($file_path), 0755, true);
		}
		file_put_contents($file_path, $css_output);
	}
}

// Trigger 1: When any admin page is loaded (checks timestamps)
add_action('admin_init', 'sync_kubio_tailwind_vars');

// Trigger 2: When the post is specifically saved (instant update)
add_action('save_post', function($post_id, $post) {
	if ($post->post_name === 'kubio-globals') {
		sync_kubio_tailwind_vars();
	}
}, 10, 2);
