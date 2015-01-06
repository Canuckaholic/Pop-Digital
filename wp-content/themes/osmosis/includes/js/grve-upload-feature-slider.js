jQuery(document).ready(function($) {

	"use strict";

	var grveFeatureSliderFrame;
	var grveFeatureSliderContainer = $( "#grve-feature-slider-container" );
	grveFeatureSliderContainer.sortable();

	$('.grve-feature-slider-item-delete-button').click(function() {
		$(this).parent().remove();
	});

	$('.grve-upload-feature-slider-button').click(function() {

        if ( grveFeatureSliderFrame ) {
            grveFeatureSliderFrame.open();
            return;
        }

        grveFeatureSliderFrame = wp.media.frames.grveFeatureSliderFrame = wp.media({
            className: 'media-frame grve-media-feature-slider-frame',
            frame: 'select',
            multiple: true,
            title: grve_upload_feature_slider_texts.modal_title,
            library: {
                type: 'image'
            },
            button: {
                text:  grve_upload_feature_slider_texts.modal_button_title
            }

        });
        grveFeatureSliderFrame.on('select', function(){
			var selection = grveFeatureSliderFrame.state().get('selection');
			var ids = selection.pluck('id');

			$('#grve-upload-feature-slider-button-spinner').show();

			$.post( grve_upload_feature_slider_texts.ajaxurl, { action:'grve_get_admin_feature_slider_media', attachment_ids: ids.toString() } , function( mediaHtml ) {
				grveFeatureSliderContainer.append(mediaHtml);
				$('.grve-feature-slider-item-delete-button.grve-item-new').click(function() {
					$(this).parent().remove();
				}).removeClass('grve-item-new');

				$('.grve-upload-replace-image.grve-item-new').bind("click",(function(){
					$(this).bindUploadReplaceImage();
				})).removeClass('grve-item-new');

				$('.grve-open-slider-modal.grve-item-new').bind("click",(function(e){
					e.preventDefault();
					$(this).bindOpenSliderModal();
				})).removeClass('grve-item-new');

				$('#grve-upload-feature-slider-button-spinner').hide();


			});
        });
        grveFeatureSliderFrame.on('ready', function(){
			$( '.media-modal' ).addClass( 'grve-media-no-sidebar' );
        });


        grveFeatureSliderFrame.open();
    });


});