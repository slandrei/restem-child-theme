// Add this to an admin-only JS file or wrap in <script> in your PHP
jQuery(document).ready(function($) {
    var frame;
    $(document).on('click', '.restem_tax_media_button', function(e) {
        e.preventDefault();
        if (frame) { frame.open(); return; }
        frame = wp.media({
            title: 'Select Featured Image',
            button: { text: 'Set featured image' },
            multiple: false
        });
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            $('#category-featured-id').val(attachment.id);
            $('#category-featured-wrapper').html('<img src="' + attachment.url + '" style="max-width:200px;display:block;margin-bottom:10px;"/>');
        });
        frame.open();
    });
    $(document).on('click', '.restem_tax_media_remove', function(e) {
        $('#category-featured-id').val('');
        $('#category-featured-wrapper').html('');
    });
});