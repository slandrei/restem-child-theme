// Înlocuiește conținutul din index.js cu acesta:
( function( blocks, element ) {
    const el = element.createElement;

    blocks.registerBlockType( 'restaurant/product-categories', {
        title: 'Restaurant Product Categories',
        icon: 'menu',
        category: 'restaurant',
        edit: function() {
            return el(
                'div',
                { style: { padding: '16px', border: '1px dashed #ccc' } },
                el( 'strong', {}, 'Product categories Block' ),
                el( 'p', {}, 'Categoriile vor fi afișate pe site.' )
            );
        },
        save: function() {
            return null; // Bloc dinamic
        },
    } );
} )( window.wp.blocks, window.wp.element );