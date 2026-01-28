import {__} from "@wordpress/i18n";
import {CheckboxControl, PanelBody, Spinner, TextControl} from "@wordpress/components";
import {useSelect} from "@wordpress/data";
import {useState} from "@wordpress/element"; // Add this for local state
import {withBlockContext} from "../../../hocs/with-block-context.js";

const SelectedCategories = ({attributes, setAttributes}) => {
    const {selectedCategories} = attributes;
    const [searchTerm, setSearchTerm] = useState(''); // Local state for search
    const [hideEmpty, setHideEmpty] = useState(true);

    const categories = useSelect((select) => {
        return select('core').getEntityRecords('taxonomy', 'product_cat', {
            per_page: -1,
            hide_empty: false,
        });
    }, []);

    // Filter categories based on search term
    const filteredCategories = categories?.filter((category) => (!hideEmpty || category.count > 0) &&
        category.name.toLowerCase().includes(searchTerm.toLowerCase())
    );

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
        <PanelBody
            title={__('Select Categories', 'product-categories')}
            className={'tw restem-selected-categories-control'}
        >
            <div className="mb-4">
                <TextControl
                    label={__('Search Categories', 'product-categories')}
                    value={searchTerm}
                    onChange={(value) => setSearchTerm(value)}
                    placeholder={__('Type to filter...', 'product-categories')}
                    autoComplete="off"
                />

                <CheckboxControl
                    label={__('Hide empty categories', 'product-categories')}
                    checked={hideEmpty}
                    onChange={setHideEmpty}
                />

                <div className="w-full border-b-[1px] my-1 opacity-20"/>
            </div>

            {!categories ? (
                <Spinner/>
            ) : (
                <>
                    {filteredCategories.length > 0 ? (
                        filteredCategories.map((category) => {
                            const isEmpty = category.count === 0;
                            return (
                                <CheckboxControl
                                    key={category.id}
                                    label={
                                        isEmpty
                                            ? `${category.name} (${__('Empty', 'product-categories')})`
                                            : `${category.name} (${category.count})`
                                    }
                                    checked={selectedCategories.includes(category.id)}
                                    onChange={() => onCategoryChange(category.id)}
                                    disabled={isEmpty}
                                />
                            );
                        })
                    ) : (
                        <p className="description">
                            {__('No categories found.', 'product-categories')}
                        </p>
                    )}
                </>
            )}
        </PanelBody>
    );
}

export default withBlockContext(SelectedCategories);