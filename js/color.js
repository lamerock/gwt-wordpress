/* Theme options: color pickers and media upload buttons. */
( function ( $ ) {
'use strict';

$( function () {
$( '.my-color-field' ).wpColorPicker();

function updateDependentFields() {
$( '#upload_image' ).closest( 'tr' ).toggle( $( '#govph_logo_enable_input' ).is( ':checked' ) );
$( '#govph_breadcrumbs_separator_input, #govph_breadcrumbs_show_home_input' ).closest( 'tr' ).toggle( $( '#govph_breadcrumbs_enable_input' ).is( ':checked' ) );
$( '#govph_content_pub_date_lbl_input' ).closest( 'tr' ).toggle( $( '#govph_content_show_pub_date_input' ).is( ':checked' ) );
$( '#govph_content_pub_author_lbl_input' ).closest( 'tr' ).toggle( $( '#govph_content_show_author_input' ).is( ':checked' ) );
}

$(
	'#govph_logo_enable_input, #govph_logo_disable_input, #govph_breadcrumbs_enable_input, ' +
	'#govph_content_show_pub_date_input, #govph_content_show_author_input'
).on( 'change', updateDependentFields );
updateDependentFields();

$( '.govph-options-nav a' ).on( 'click', function () {
var target = document.getElementById( this.hash.slice( 1 ) );

if ( target ) {
window.setTimeout( function () {
var heading = target.previousElementSibling;

if ( heading && 'H2' === heading.tagName ) {
heading.setAttribute( 'tabindex', '-1' );
heading.focus();
} else {
target.focus();
}
}, 0 );
}
} );

function updateImagePreview( input ) {
var imageInput = $( input );
var preview = $( '#' + imageInput.attr( 'id' ) + '_preview' );
var imageUrl = $.trim( imageInput.val() );

if ( imageUrl ) {
preview.find( 'img' ).attr( 'src', imageUrl ).prop( 'hidden', false );
} else {
preview.find( 'img' ).removeAttr( 'src' ).prop( 'hidden', true );
}
preview.prop( 'hidden', ! imageUrl );
}

var buttons = {
'#upload_image_button': '#upload_image',
'#header_image_background_button': '#header_image_background',
'#slider_image_background_button': '#slider_image_background'
};

$.each( buttons, function ( buttonSelector, fieldSelector ) {
var imageInput = $( fieldSelector );

imageInput.on( 'input change', function () {
updateImagePreview( this );
} );

$( buttonSelector ).on( 'click', function ( event ) {
event.preventDefault();

var frame = wp.media( {
title: 'Select or upload image',
button: { text: 'Use selected image' },
library: { type: 'image' },
multiple: false
} );

frame.on( 'select', function () {
var attachment = frame.state().get( 'selection' ).first();

if ( attachment ) {
imageInput.val( attachment.toJSON().url );
updateImagePreview( imageInput );
}
} );

frame.open();
} );
} );

$( '.govph-remove-image' ).on( 'click', function () {
var imageInput = $( '#' + $( this ).data( 'target' ) );

imageInput.val( '' ).trigger( 'change' ).trigger( 'focus' );
} );
} );
}( jQuery ) );
