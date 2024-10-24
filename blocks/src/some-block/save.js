import { useBlockProps } from "@wordpress/block-editor";

export default function save({ attributes }) {
    const blockProps = useBlockProps.save();

    return (
        <div {...blockProps}>
            <p
                className={`${blockProps.className} flex bg-slate-500 text-white p-2`}
            >
                {attributes.text}
            </p>
        </div>
    );
}
