import {useSelect, useDispatch} from '@wordpress/data';
import {useBlockEditContext} from '@wordpress/block-editor';

/**
 * withBlockContext - A Higher-Order Component to inject block attributes
 * and setAttributes into any component.
 */
export const withBlockContext = (WrappedComponent) => {
    return (props) => {
        const {clientId} = useBlockEditContext();

        // 1. Get Attributes
        const attributes = useSelect(
            (select) => select('core/block-editor').getBlockAttributes(clientId),
            [clientId]
        );

        // 2. Get setAttributes function
        const {updateBlockAttributes} = useDispatch('core/block-editor');

        const setAttributes = (newAttrs) => {
            updateBlockAttributes(clientId, newAttrs);
        };

        // If we aren't inside a block context yet, return null or the original component
        if (!clientId) {
            return <WrappedComponent {...props} />;
        }

        return (
            <WrappedComponent
                {...props}
                attributes={attributes}
                setAttributes={setAttributes}
                clientId={clientId}
            />
        );
    };
};