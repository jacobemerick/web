$(function() {
	$('#menu .drop-li').hover(function() {
		$('.menu-dropdown').stop(true, true).slideDown();
	}, function() {
		$('.menu-dropdown').stop(true, true).slideUp();
	});
});