jQuery(document).ready(function($) {

	"use strict";

	var grveMediaImageReplaceFrame;
	var grveMediaImageReplaceContainer;
	var grveMediaImageReplaceMode;
	var grveMediaImageReplaceImage;

	$('.grve-upload-replace-image').bind("click",(function(){
		$(this).bindUploadReplaceImage();
	}));


	$.fn.bindUploadReplaceImage = function(){

		grveMediaImageReplaceContainer = $(this).parent().find('.grve-thumb-container');
		grveMediaImageReplaceMode = grveMediaImageReplaceContainer.data('mode');
		grveMediaImageReplaceImage = $(this).parent().find('.grve-thumb');

        if ( grveMediaImageReplaceFrame ) {
            grveMediaImageReplaceFrame.open();
            return;
        }


        grveMediaImageReplaceFrame = wp.media.frames.grveMediaImageReplaceFrame = wp.media({
            className: 'media-frame grve-media-replace-image-frame',
            frame: 'select',
            multiple: false,
            title: grve_upload_image_replace_texts.modal_title,
            library: {
                type: 'image'
            },
            button: {
                text:  grve_upload_image_replace_texts.modal_button_title
            }

        });

        grveMediaImageReplaceFrame.on('select', function(){
			var selection = grveMediaImageReplaceFrame.state().get('selection');
			var ids = selection.pluck('id');
			$('.grve-upload-replace-image').unbind("click").css({ 'cursor': 'wait' });
			grveMediaImageReplaceImage.remove();
			$.post( grve_upload_image_replace_texts.ajaxurl, { action:'grve_get_replaced_image', attachment_id: ids.toString(), attachment_mode: grveMediaImageReplaceMode } , function( mediaHtml ) {
				grveMediaImageReplaceContainer.html(mediaHtml);
				$('.grve-upload-replace-image').bind("click",(function(){
					$(this).bindUploadReplaceImage();
				})).css({ 'cursor': 'pointer' });
			});
        });

        grveMediaImageReplaceFrame.open();
    }


});