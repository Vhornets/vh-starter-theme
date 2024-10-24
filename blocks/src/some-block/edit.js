import { __ } from "@wordpress/i18n";
import { useBlockProps, RichText } from "@wordpress/block-editor";
import "./editor.scss";

export default function Edit({ attributes, setAttributes }) {
    const blockProps = useBlockProps();

    return (
        <div {...blockProps}>
            <RichText
                className={`flex bg-slate-500 text-white p-2`}
                value={attributes.text}
                onChange={(text) => setAttributes({ text })}
            />
        </div>
    );
}
