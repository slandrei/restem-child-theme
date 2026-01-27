import { useBlockProps } from '@wordpress/block-editor';
import './editor.scss';
import Component from "./component.js";
import Controls from "./controls/index.js";

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( {
		className: 'restem-product-categories-editor-preview',
	} );

	return (
		<div { ...blockProps }>
			<Controls />
            <Component />
		</div>
	);
}
