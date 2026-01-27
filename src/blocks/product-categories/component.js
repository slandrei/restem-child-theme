import {__} from "@wordpress/i18n";
import {withBlockContext} from "../../hocs/with-block-context.js";

const Component = ({attributes}) => {
    const {selectedCategories} = attributes;

    return (
        <>
            <strong>{__('Product Categories Block', 'product-categories')}</strong>
            <p>{__('Categories will be displayed on the site.', 'product-categories')}</p>
            <ul>
                {selectedCategories.length > 0 ? (
                    <li>
                        {__('Selected categories: ', 'product-categories')}
                        {selectedCategories.length}
                    </li>
                ) : (
                    <li>
                        {__('All categories are displayed (no selection).', 'product-categories')}
                    </li>
                )}
            </ul>
        </>
    )
}

export default withBlockContext(Component);