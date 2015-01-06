jQuery(document).ready(function($) {

	"use strict";

	$('#grve-post-type-video-mode').change(function() {

		$( '.grve-post-video-embed' ).hide();
		$( '.grve-post-video-html5' ).hide();

		if( 'html5' == $(this).val() ) {
			$( '.grve-post-video-html5' ).stop( true, true ).fadeIn(500);
		} else {
			$( '.grve-post-video-embed' ).stop( true, true ).fadeIn(500);
		}

    });
	
	$('#grve-post-type-audio-mode').change(function() {

		$( '.grve-post-audio-embed' ).hide();
		$( '.grve-post-audio-html5' ).hide();

		if( 'html5' == $(this).val() ) {
			$( '.grve-post-audio-html5' ).stop( true, true ).fadeIn(500);
		} else {
			$( '.grve-post-audio-embed' ).stop( true, true ).fadeIn(500);
		}

    });	

	function grveCheckPostFormat() {
		var format = $('#post-formats-select input:checked').attr('value');
		if(typeof format != 'undefined') {

			$( '#post-body div[id^=grve-meta-box-post-format-]' ).hide();
			$( '#post-body #grve-meta-box-post-format-' + format ).stop( true, true ).fadeIn(500);

		}
	}

	$(window).load(function(){
		grveCheckPostFormat();
		$('#grve-post-gallery-mode').change();
		$('#grve-post-type-video-mode').change();
		$('#grve-post-type-audio-mode').change();
		$('#post-formats-select input').change(grveCheckPostFormat);
	})

});