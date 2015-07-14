jQuery(function ($) {
	var endDate = new Date('$EndDate');
	$('#clock').countdown(endDate, function(event) {
		$(this).html(event.strftime('%D days %H:%M:%S'));
	});
});
