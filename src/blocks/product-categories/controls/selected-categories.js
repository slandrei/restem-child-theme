import {__} from "@wordpress/i18n";
import {CheckboxControl, PanelBody, Spinner} from "@wordpress/components";
import {useSelect} from "@wordpress/data";
import {withBlockContext} from "../../../hocs/with-block-context.js";


const SelectedCategories = ({attributes, setAttributes}) => {

    const {selectedCategories} = attributes;

    const categories = useSelect((select) => {
        return select('core').getEntityRecords('taxonomy', 'product_cat', {
            per_page: -1,
            hide_empty: false,
        });
    }, []);

    const onCategoryChange = (categoryId) => {
        let newSelectedCategories = [...selectedCategories];
        if (newSelectedCategories.includes(categoryId)) {
            newSelectedCategories = newSelectedCategories.filter(
                (id) => id !== categoryId
            );
        } else {
            newSelectedCategories.push(categoryId);
        }
        setAttributes({selectedCategories: newSelectedCategories});
    };


    return (
        <PanelBody title={__('Select Categories', 'product-categories')}>
            {!categories ? (
                <Spinner/>
            ) : (
                categories.map((category) => (
                    <CheckboxControl
                        key={category.id}
                        label={category.name}
                        checked={selectedCategories.includes(category.id)}
                        onChange={() => onCategoryChange(category.id)}
                    />
                ))
            )}
        </PanelBody>
    )
}

export default withBlockContext(SelectedCategories);
