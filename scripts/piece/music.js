$(function() {

	var height = $(window).height();
	var width = $(window).width();

	if($('#warning').length)
	{
		$('#warning').css('left', width / 2 - 300 + 'px');
		$('#warning').css('top', height / 2 - 100 + 'px');
		return;
	}

	$('#welcome').css('left', width/2 - 300 + 'px');

	$(window).resize(function() {
		$('<div id="resize-message">You resized the window! Refresh the page to update the layout.</div>').
			appendTo('#container').
			css('left', width - 300 + 'px').
			css('top', height - 80 + 'px');
	});

	changeBackground();

	$('#loading').text('loading');
	$('#loading').css('left', width - 300 + 'px');
	loadingDots();

	$.post(
		'/get/popularMusic.json',
		{
			'height' : height,
			'width' : width
		},
		function(data) {
			$('#loading').fadeOut(function() {
				clearTimeout(loading_dots);
			});
			
			if($('#welcome').hasClass('up'))
			{
				$('#welcome').animate({
					top: height - 420 + 'px'
				}).animate({
					top: height - 400 + 'px'
				});
			}
			else
			{
				$('#welcome-toggle').text('[+] show');
				$('#welcome').animate({
					top: height - 45 + 'px'
				}).animate({
					top: height - 35 + 'px'
				}, function() {
					$('#click-block').hide();
				});
			}
			var cachedImages = new Array();
			$('#albums').append('<ul id="listing"></ul>');
			$.each(data.popular_music, function(album_key, album) {
				var display_image = document.createElement('img');
				var color_image = document.createElement('img');
				var large_image = document.createElement('img');
				
				$(display_image, color_image, large_image).load(function() {
					cachedImages.push(display_image, color_image, large_image);
					$('#listing').append('<li style="left: ' + album.left + 'px; top: ' + album.top + 'px;" rel="' + album_key + '"><img class="bw" src="' + album.display_image + '" /><img class="color" src="' + album.color_image + '" style="display: none" /></li>');
					$('#listing li:last').hide().fadeIn('slow');
				});
				
				display_image.src = album.display_image;
				color_image.src = album.color_image;
				large_image.src = album.large_image;
			});
			popularMusic = data.popular_music;
		}
	);

	$('#welcome-toggle').click(function() {
		if($('#welcome').hasClass('up'))
		{
			$('#welcome-toggle').text('[+] show');
			$('#welcome').animate({
				top: height - 25 + 'px'
			}).animate({
				top: height - 35 + 'px'
			}, function() {
				$('#click-block').hide();
				$('#welcome').removeClass('up').addClass('down');
			});
		}
		else
		{
			$('#welcome-toggle').text('[-] hide');
			if($('#showcase:visible').length)
				$('#showcase').fadeOut();
			$('#welcome').animate({
				top: height - 420 + 'px'
			}).animate({
				top: height - 400 + 'px'
			}, function() {
				$('#click-block').show();
				$('#welcome').removeClass('down').addClass('up');
			});
		}
	});

	$('#listing li').live('hover', function(event) {
		if(event.type == 'mouseover') {
			$(this).find('.bw').stop(false, true).fadeOut();
			$(this).find('.color').stop(false, true).fadeIn();
		} else {
			$(this).find('.color').stop(false, true).fadeOut('slow');
			$(this).find('.bw').stop(false, true).fadeIn();
		}
	});

	$('#showcase').css('left', Math.floor((width - 980) / 2));
	$('#listing li').live('click', function() {
		var album = popularMusic[$(this).attr('rel')];
		
		$('#showcase-image').empty();
		$('#showcase-image').append('<img src="' + album.large_image + '" />');
		$('#showcase-artist').text(album.artist);
		$('#showcase-album').text(album.album);
		
		$('#showcase').fadeIn(function() {
			$('#click-block').show()
		});
	});
	$('#click-block, #showcase-close').live('click', function() {
		if($('#showcase:visible').length)
		{
			$('#showcase').fadeOut(function() {
				$('#click-block').hide()
			});
		}
	});
	$('#showcase').live('click', function(e) {
		return false;
	});
});

function changeBackground()
{
	$('#background').animate({backgroundColor: pickBackground()}, 4000);
	
	setTimeout("changeBackground()", 8000);
}

var loading_dots;
function loadingDots()
{
	$('#loading').text(function() {
		var text = $(this).text();
		if(text.split('.').length > 3)
			return text.split('.')[0];
		return text + '.';
	});
	
	loading_dots = setTimeout("loadingDots()", 1000);
}

function pickBackground()
{
	var colors = [
		'#1f758c',
		'#1f3e8c',
		'#8c1f75',
		'#8c1f3e',
		'#758c1f',
		'#3e8c1f'];
	
	var rand_color_key = Math.floor(Math.random() * colors.length);
	return colors[rand_color_key];
}