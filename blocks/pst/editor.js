(function (blocks, blockEditor, element, i18n) {
	var el = element.createElement;
	var __ = i18n.__;

	blocks.registerBlockType('gwt/pst', {
		apiVersion: 3,
		title: __('Philippine Standard Time', 'gwt_wp'),
		category: 'widgets',
		icon: 'clock',
		edit: function () {
			return el(
				'div',
				blockEditor.useBlockProps(),
				el('strong', {}, __('Philippine Standard Time', 'gwt_wp'))
			);
		},
		save: function () {
			return null;
		}
	});
})(wp.blocks, wp.blockEditor, wp.element, wp.i18n);