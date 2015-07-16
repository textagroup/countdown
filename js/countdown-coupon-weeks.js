jQuery(function ($) {
	var endDate = new Date('$EndDate');
	$('#$ElementID').countdown(endDate, function(event) {
		$(this).html(event.strftime('%w weeks %d days %H:%M:%S'));
	});
});
