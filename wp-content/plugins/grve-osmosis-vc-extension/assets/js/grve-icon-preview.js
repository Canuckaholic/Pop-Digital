
(function ($) {

	$('.grve-modal-icon-preview').click(function() {
		var selectedIcon = $(this);
		$('.grve-modal-icon-preview').removeClass('grve-selected');
		selectedIcon.addClass('grve-selected');
		selectedIcon.parent().next('input').val(selectedIcon.data( 'icon-value' ));
	});

	var initialIconValue = $('#grve-icon-field').val();
	var thisIconElement = $('.grve-modal-icon-preview.fa-' + initialIconValue );

	if ( thisIconElement.length ) {
		thisIconElement.click();
		$(".grve-modal-select-icon-container").scrollTop( thisIconElement.position().top - 175 );
	}


})(jQuery);