import { registerBlockType } from "@wordpress/blocks";

import "./style.scss";

import Edit from "./edit";
import save from "./save";
import metadata from "./block.json";

const { name, attributes } = metadata;

registerBlockType(name, {
    attributes,
    edit: Edit,
    save,
});
