jQuery(document).ready(function($) {

	"use strict";

	$('.grve-import-dummy-data').click(function() {

		var grveConfirm = confirm(grve_import_texts.confirmation_text);
		if ( grveConfirm == true ) {

			$('#grve-import-output-info').hide().html('');
			$('#grve-import-output-container').hide().html('');

			$('.grve-import-dummy-data').attr('disabled','disabled').addClass('disabled');
			$('#grve-import-dummy-list').hide();

			$('#grve-import-loading').show();
			$('#grve-import-countdown').show();

			var startTime = new Date();
			$('#grve-import-countdown').countdown('destroy');
			$('#grve-import-countdown').countdown({since: startTime, format: 'MS'});

			var dummyID = $(this).data('dummy-id');
			var dummyContent = $(this).parent().parent().find('.grve-admin-dummy-option-dummy-content').is(':checked');
			var dummyOptions = $(this).parent().parent().find('.grve-admin-dummy-option-theme-options').is(':checked');
			var dummyWidgets = $(this).parent().parent().find('.grve-admin-dummy-option-widgets').is(':checked');
			var dummyNonce = $(this).parent().parent().find('.grve-admin-dummy-option-dummy-nonce').val();

			$.post(
				ajaxurl, {
					action:'grve_import_dummy_data',
					grve_import_data: dummyID,
					grve_import_content: dummyContent,
					grve_import_options: dummyOptions,
					grve_import_widgets: dummyWidgets,
					nonce: dummyNonce
				},
				function( response ) {
					$('#grve-import-countdown').countdown('pause');
					$('#grve-import-loading').hide();
					if ( '-1' != response ) {
						if(response.changed){
							$('#grve-import-output-info').show().append(response.info);
							$('#grve-import-output-container').show().append(response.output);
							$('.grve-import-dummy-data').removeAttr('disabled').removeClass('disabled');
						} else {
							$('#grve-import-countdown').hide();
							$('#grve-import-output-info').show().append(response.info);
							$('#grve-import-dummy-list').show();
							$('.grve-import-dummy-data').removeAttr('disabled').removeClass('disabled');
						}
					}
				}
			);
		}

	});

});