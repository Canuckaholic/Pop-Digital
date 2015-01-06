jQuery(document).ready(function($) {

	"use strict";

	//Feature Map
	$('.grve-map-item-delete-button').click(function() {
		$(this).parent().remove();
	});

	$('#grve-upload-multi-map-point').click(function() {

		$('#grve-upload-multi-map-point').attr('disabled','disabled').addClass('disabled');
		$('#grve-upload-multi-map-button-spinner').show();


		$.post( grve_feature_section_texts.ajaxurl, { action:'grve_get_map_point', map_mode:'new' } , function( mediaHtml ) {
			$('#grve-feature-map-container').append(mediaHtml);

			$('.grve-map-item-delete-button.grve-item-new').click(function() {
				$(this).parent().remove();
			}).removeClass('grve-item-new');

			$('.grve-open-map-modal.grve-item-new').bind("click",(function(e){
				e.preventDefault();
				$(this).bindOpenMapModal();
			})).removeClass('grve-item-new');

			$('.grve-remove-simple-media-button.grve-item-new').click(function() {
				$(this).bindRemoveSimpleMedia();
			}).removeClass('grve-item-new');
			$('.grve-upload-simple-media-button.grve-item-new').click(function() {
				$(this).bindUploadSimpleMedia();
			}).removeClass('grve-item-new');


			$('#grve-upload-multi-map-point').removeAttr('disabled').removeClass('disabled');
			$('#grve-upload-multi-map-button-spinner').hide();
		});
	});



	$('#grve-page-feature-element').change(function() {

		$('.grve-feature-section-item').hide();

		switch($(this).val())
        {
			case "title":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-effect').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-style').stop( true, true ).fadeIn(500);
				$('#grve-feature-title-container').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-go-to-section').stop( true, true ).fadeIn(500);
            break;
            case "image":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-effect').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-style').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-image').stop( true, true ).fadeIn(500);
				$('#grve-feature-image-container').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-go-to-section').stop( true, true ).fadeIn(500);
            break;
			 case "video":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-effect').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-video').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-style').stop( true, true ).fadeIn(500);
				$('#grve-feature-video-container').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-go-to-section').stop( true, true ).fadeIn(500);
            break;
			case "slider":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-effect').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider-speed').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider-pause').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider-direction-nav').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider-direction-nav-color').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider-transition').stop( true, true ).fadeIn(500);
				$('#grve-feature-slider-container').stop( true, true ).fadeIn(500);
            break;
			case "map":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-style').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-map').stop( true, true ).fadeIn(500);
				$('#grve-feature-map-container').stop( true, true ).fadeIn(500);
            break;
            default:
			break;
        }
    });


	$('#grve-portfolio-media-selection').change(function() {

		$('.grve-portfolio-media-item').hide();

		switch($(this).val())
        {
			case "gallery":
			case "gallery-vertical":
				$('#grve-portfolio-media-slider').stop( true, true ).fadeIn(500);
				$('#grve-slider-container').stop( true, true ).fadeIn(500);
            break;
			case "slider":
				$('#grve-portfolio-media-slider').stop( true, true ).fadeIn(500);
				$('#grve-portfolio-media-slider-speed').stop( true, true ).fadeIn(500);
				$('#grve-portfolio-media-slider-direction-nav').stop( true, true ).fadeIn(500);
				$('#grve-slider-container').stop( true, true ).fadeIn(500);
            break;
			case "video":
				$('.grve-portfolio-video-embed').stop( true, true ).fadeIn(500);
			break;
			case "video-html5":
				$('.grve-portfolio-video-html5').stop( true, true ).fadeIn(500);
			break;
            default:
			break;
        }
    });

	$('#grve-page-feature-size').change(function() {

		if( 'custom' == $(this).val() )
        {
			$('#grve-feature-section-height').stop( true, true ).fadeIn(500);
		} else {
			$('#grve-feature-section-height').hide();
		}

    });

	$(window).load(function(){
		$('#grve-page-feature-element').change();
		$('#grve-portfolio-media-selection').change();
		$('#grve-page-feature-size').change();
	});

	$('.wp-color-picker-field').wpColorPicker();


});