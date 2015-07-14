jQuery(function ($) {
	var endDate = new Date('$EndDate');
	$('#clock').countdown(endDate, function(event) {
		var $this = $(this).html(event.strftime(''
		+ '<span>%w</span> weeks '
		+ '<span>%d</span> days '
		+ '<span>%H</span> hr '
		+ '<span>%M</span> min '
		+ '<span>%S</span> sec'));
	});
});
