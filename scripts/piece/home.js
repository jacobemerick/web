$(function() {
	$('#main_links a').click(
		function() {
			Track.action('home_link', 'click', $(this).attr('href'));});
	$('#social_links a').click(
		function() {
			Track.action('social_link', 'click', $(this).attr('href'));});
	$('#display_login').click(
		function() {});});