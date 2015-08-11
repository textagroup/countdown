jQuery(function ($) {
	var endDate = new Date('$EndDate');
	var template = '<span class="days">%D</span> <span class="text-days">days</span>';
	$('#$ElementID').countdown(endDate, function(event) {
		$(this).html(event.strftime(template));
	});
});
