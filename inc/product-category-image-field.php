<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
// 1. Add field to "Add New Category" screen
add_action('product_cat_add_form_fields', 'restem_add_category_featured_image');
function restem_add_category_featured_image() {
	?>
	<div class="form-field term-group">
		<label><?php _e('Featured Image', 'woocommerce'); ?></label>
		<input type="hidden" id="category-featured-id" name="category-featured-id" value="">
		<div id="category-featured-wrapper"></div>
		<p>
			<input type="button" class="button button-secondary restem_tax_media_button" value="<?php _e('Set featured image', 'woocommerce'); ?>" />
			<input type="button" class="button button-secondary restem_tax_media_remove" value="<?php _e('Remove featured image', 'woocommerce'); ?>" />
		</p>
	</div>
	<?php
}

// 2. Add field to "Edit Category" screen
add_action('product_cat_edit_form_fields', 'restem_edit_category_featured_image');
function restem_edit_category_featured_image($term) {
	$image_id = get_term_meta($term->term_id, '_category_featured_image_id', true);
	$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';
	?>
	<tr class="form-field term-group">
		<th scope="row"><label><?php _e('Featured Image', 'woocommerce'); ?></label></th>
		<td>
			<input type="hidden" id="category-featured-id" name="category-featured-id" value="<?php echo $image_id; ?>">
			<div id="category-featured-wrapper">
				<?php if ($image_url) : ?>
					<img src="<?php echo esc_url($image_url); ?>" style="margin-bottom:10px;max-width:200px;display:block;" />
				<?php endif; ?>
			</div>
			<input type="button" class="button button-secondary restem_tax_media_button" value="<?php _e('Set featured image', 'woocommerce'); ?>" />
			<input type="button" class="button button-secondary restem_tax_media_remove" value="<?php _e('Remove featured image', 'woocommerce'); ?>" />
		</td>
	</tr>
	<?php
}

// 3. Save the Data
add_action('edited_product_cat', 'restem_save_category_featured_image');
add_action('create_product_cat', 'restem_save_category_featured_image');
function restem_save_category_featured_image($term_id) {
	if (isset($_POST['category-featured-id'])) {
		update_term_meta($term_id, '_category_featured_image_id', $_POST['category-featured-id']);
	}
}

add_action('admin_enqueue_scripts', function($hook) {
	// Only load on category pages to keep admin fast
	if ('edit-tags.php' !== $hook && 'term.php' !== $hook) return;

	wp_enqueue_media();
});