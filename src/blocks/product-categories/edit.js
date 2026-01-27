/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, CheckboxControl, Spinner } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import './editor.scss';
import Component from "./component.js";
import Controls from "./controls/index.js";

export default function Edit( { attributes, setAttributes, ...rest } ) {
	const blockProps = useBlockProps( {
		className: 'restem-product-categories-editor-preview',
	} );

	return (
		<>
			<Controls />
            <Component {...blockProps}/>
		</>
	);
}
