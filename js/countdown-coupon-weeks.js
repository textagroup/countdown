jQuery(function ($) {
	var endDate = new Date('$EndDate');
	var template = '<span class="weeks">%w</span> <span class="text-weeks">weeks</span> <span class="days">%d</span> <span class="text-days">days</span> <span class="time">%H:%M:%S</span>';
	$('.$ElementClass').countdown(endDate, function(event) {
		$(this).html(event.strftime('%w weeks %d days %H:%M:%S'));
	});
});
