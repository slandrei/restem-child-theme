// Înlocuiește conținutul din index.js cu acesta:
( function( blocks, element, blockEditor, components, data ) {
    const el = element.createElement;
    const { InspectorControls } = blockEditor;
    const { PanelBody, CheckboxControl, Spinner } = components;
    const { useSelect } = data;

    blocks.registerBlockType( 'restaurant/product-categories', {
        title: 'Restaurant Product Categories',
        icon: 'menu',
        category: 'restaurant',
        edit: function( props ) {
            const { attributes, setAttributes } = props;
            const { selectedCategories } = attributes;

            const categories = useSelect( ( select ) => {
                return select( 'core' ).getEntityRecords( 'taxonomy', 'product_cat', {
                    per_page: -1,
                    hide_empty: false,
                } );
            }, [] );

            const onCategoryChange = ( categoryId ) => {
                let newSelectedCategories = [ ...selectedCategories ];
                if ( newSelectedCategories.includes( categoryId ) ) {
                    newSelectedCategories = newSelectedCategories.filter( ( id ) => id !== categoryId );
                } else {
                    newSelectedCategories.push( categoryId );
                }
                setAttributes( { selectedCategories: newSelectedCategories } );
            };

            return el(
                element.Fragment,
                {},
                el(
                    InspectorControls,
                    {},
                    el(
                        PanelBody,
                        { title: 'Selectează Categorii' },
                        ! categories
                            ? el( Spinner )
                            : categories.map( ( category ) => {
                                  return el( CheckboxControl, {
                                      label: category.name,
                                      checked: selectedCategories.includes( category.id ),
                                      onChange: () => onCategoryChange( category.id ),
                                  } );
                              } )
                    )
                ),
                el(
                    'div',
                    { style: { padding: '16px', border: '1px dashed #ccc' } },
                    el( 'strong', {}, 'Product categories Block' ),
                    el( 'p', {}, 'Categoriile vor fi afișate pe site.' ),
                    el(
                        'ul',
                        {},
                        selectedCategories.length > 0
                            ? el( 'li', {}, 'Categorii selectate: ' + selectedCategories.length )
                            : el( 'li', {}, 'Toate categoriile sunt afișate (nicio selecție).' )
                    )
                )
            );
        },
        save: function() {
            return null; // Bloc dinamic
        },
    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.components,
    window.wp.data
);