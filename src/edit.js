import { TextControl, SelectControl } from '@wordpress/components';

/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();
	const updateValueMashup = (val) => {
		setAttributes({ mashup: val });
	};
	return (
		<div {...blockProps}>
			<h4>GpsNose</h4>
			<SelectControl
				label={__('Display', 'gpsnose')}
				value={attributes.type}
				options={[
					{ label: __('Members', 'gpsnose'), value: 'members' },
					{ label: __('Login', 'gpsnose'), value: 'login' },
				]}
				onChange={(val) => setAttributes({ type: val })}
			/>
			<TextControl
				label={__('Mashup', 'gpsnose')}
				value={attributes.mashup}
				onChange={(val) => setAttributes({ mashup: val })}
			/>
			<hr />
		</div>
	);
}
