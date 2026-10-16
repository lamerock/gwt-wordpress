/* Theme options: color pickers and media upload buttons. */
( function ( $ ) {
'use strict';

$( function () {
$( '.my-color-field' ).wpColorPicker();

var buttons = {
'#upload_image_button': '#upload_image',
'#header_image_background_button': '#header_image_background',
'#slider_image_background_button': '#slider_image_background'
};

$.each( buttons, function ( buttonSelector, fieldSelector ) {
$( buttonSelector ).on( 'click', function ( event ) {
event.preventDefault();

var frame = wp.media( {
title: 'Select or Upload Image',
button: { text: 'Use this image' },
library: { type: 'image' },
multiple: false
} );

frame.on( 'select', function () {
$( fieldSelector ).val( frame.state().get( 'selection' ).first().toJSON().url );
} );

frame.open();
} );
} );
} );
}( jQuery ) );
