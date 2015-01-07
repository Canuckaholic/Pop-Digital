
(function ($) {

	$('.grve-checkbox-input-item-all').click(function() {
		var $this = $(this);
		var $checkboxes_input = $this.parent().parent().find('.wpb-checkboxes');
		if ( $this.is(':checked') ) {
			$('.grve-checkbox-input-item').removeAttr('checked');
			$('.grve-checkbox-input-item').attr('disabled','disabled');
			$checkboxes_input.val('');
		} else {
			$('.grve-checkbox-input-item').removeAttr('disabled');
		}
	});

	if ( $('.grve-checkbox-input-item-all').is(':checked') ) {
		$('.grve-checkbox-input-item').attr('disabled','disabled');
	}

	$('.grve-checkbox-input-item').click(function() {
		$('.grve-checkbox-input-item-all').removeAttr('checked');

		var $this = $(this);
		var $checkboxes_input = $this.parent().parent().find('.wpb-checkboxes');
		var arrayValues = $checkboxes_input.val().split(',');

		if ( $this.is(':checked') ) {
			arrayValues.push($this.val());
			var emptyKey = arrayValues.indexOf("");
			if ( emptyKey > -1 ) {
				arrayValues.splice( emptyKey, 1 );
			}
		} else {
			var foundKey = arrayValues.indexOf( $this.val() );
			if ( foundKey > -1 ) {
				arrayValues.splice( foundKey, 1 );
			}
		}
		$checkboxes_input.val( arrayValues.join(',') );
	});


})(jQuery);