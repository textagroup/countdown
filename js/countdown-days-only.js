jQuery(function ($) {
	var endDate = new Date('$EndDate');
	$('#$ElementID').countdown(endDate, function(event) {
		$(this).html(event.strftime('%D days'));
	});
});
