$(function() {
	$('#search-submit').click(
		function() {
			var search_url = $(this).closest('form').attr('action');
			var search_term = $('#search-box').val();
			window.location = search_url + search_term + '/';
			return false;});
	$('#search-box').hint();
	$('.prev-archive').click(
		function() {
			$('.archive-table').animate({
				marginLeft: ($.browser.msie) ? '+=218' : '+=189'},
			500);});
	$('.next-archive').click(
		function() {
			$('.archive-table').animate({
				marginLeft: ($.browser.msie) ? '-=218' : '-=189'},
			500);});});