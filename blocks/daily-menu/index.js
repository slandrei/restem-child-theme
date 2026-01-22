// Înlocuiește conținutul din index.js cu acesta:
( function( blocks, element ) {
    const el = element.createElement;

    blocks.registerBlockType( 'restaurant/daily-menu', {
        title: 'Restaurant Daily Menu',
        icon: 'menu',
        category: 'widgets',
        edit: function() {
            return el(
                'div',
                { style: { padding: '16px', border: '1px dashed #ccc' } },
                el( 'strong', {}, 'Daily Menu Block' ),
                el( 'p', {}, 'Produsele din meniul zilei vor fi afișate pe site.' )
            );
        },
        save: function() {
            return null; // Bloc dinamic
        },
    } );
} )( window.wp.blocks, window.wp.element );