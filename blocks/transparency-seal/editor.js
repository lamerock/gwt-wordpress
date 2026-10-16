(function (blocks, blockEditor, components, element, i18n) {
	var el = element.createElement;
	var __ = i18n.__;

	blocks.registerBlockType('gwt/transparency-seal', {
		apiVersion: 3,
		title: __('Transparency Seal', 'gwt_wp'),
		category: 'widgets',
		icon: 'admin-site-alt3',
		attributes: {
			url: {
				type: 'string',
				default: 'https://domain.gov.ph/transparency'
			}
		},
		edit: function (props) {
			return el(
				'div',
				blockEditor.useBlockProps(),
				[
					el(
						blockEditor.InspectorControls,
						{},
						el(
							components.PanelBody,
							{ title: __('Transparency Seal Settings', 'gwt_wp') },
							el(components.TextControl, {
								label: __('Transparency page URL', 'gwt_wp'),
								value: props.attributes.url,
								onChange: function (url) {
									props.setAttributes({ url: url });
								}
							})
						)
					),
					el('img', {
						src: govphTransparencyBlock.imageUrl,
						alt: __('Transparency Seal logo', 'gwt_wp'),
						style: { display: 'block', margin: '0 auto', maxWidth: '160px' }
					})
				]
			);
		},
		save: function () {
			return null;
		}
	});
})(wp.blocks, wp.blockEditor, wp.components, wp.element, wp.i18n);