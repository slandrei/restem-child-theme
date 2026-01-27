import {InspectorControls} from "@wordpress/block-editor";
import SelectedCategories from "./selected-categories.js";
import {withBlockContext} from "../../../hocs/with-block-context.js";


const Controls = ({attributes, setAttributes}) => {


    return (
        <InspectorControls>
            <SelectedCategories />
        </InspectorControls>
    )
}

export default withBlockContext(Controls);