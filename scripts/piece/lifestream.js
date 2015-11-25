$(function() {
	$('.post').hover(
		function() {
			if($(this).hasClass('twitter'))
				$(this).find('.type').stop().animate({color: '#9eb1e9'});
			if($(this).hasClass('coding'))
				$(this).find('.type').stop().animate({color: '#b7a0db'});
			if($(this).hasClass('hiking'))
				$(this).find('.type').stop().animate({color: '#be6d0e'});
			if($(this).hasClass('buzz'))
				$(this).find('.type').stop().animate({color: '#f1ce67'});
			if($(this).hasClass('hulu'))
				$(this).find('.type').stop().animate({color: '#b3db83'});
			if($(this).hasClass('lastfm'))
				$(this).find('.type').stop().animate({color: '#e57b7e'});
			if($(this).hasClass('blog'))
				$(this).find('.type').stop().animate({color: '#f8922c'});
			if($(this).hasClass('book'))
				$(this).find('.type').stop().animate({color: '#81c5d6'});
			$(this).find('.sprite').stop().animate({backgroundPosition: $(this).find('.sprite').css('backgroundPosition').split(' ')[0] + ' -24px'});},
		function() {
			$(this).find('.type').stop().animate({color: '#ccc'}, 'fast');
			$(this).find('.sprite').stop().animate({backgroundPosition: $(this).find('.sprite').css('backgroundPosition').split(' ')[0] + ' 0'}, 'fast');});
	$('#lifestream-menu .sprite.active').hover(
		function() {
			$(this).stop().animate({backgroundPosition: $(this).css('backgroundPosition').split(' ')[0] + ' 0'});},
		function() {
			$(this).stop().animate({backgroundPosition: $(this).css('backgroundPosition').split(' ')[0] + ' -24px'}, 'fast');});
	$('#lifestream-menu .sprite.inactive').hover(
		function() {
			$(this).stop().animate({backgroundPosition: $(this).css('backgroundPosition').split(' ')[0] + ' -24px'});},
		function() {
			$(this).stop().animate({backgroundPosition: $(this).css('backgroundPosition').split(' ')[0] + ' 0'}, 'fast');});});