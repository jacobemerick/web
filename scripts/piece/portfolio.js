$(function() {
	$('#thumb-list li').live('click', function() {
		if($(this).hasClass('active'))
			return;
		$('#piece-image').hide();
		$.post(
			'/get/portfolioImage.json',
			{portfolio_id: $(this).find('img').attr('rel')},
			function(data) {
				$('#piece-image').attr('rel', data.image.id);
				$('#piece-image').attr('src', data.image.link);
				$('#piece-image').attr('width', data.image.width);
				$('#piece-image').attr('height', data.image.height);});
		$('#thumb-list li').removeClass('active');
		$(this).addClass('active');});
	
	$('#thumb-list img[rel=' + $('#piece-image').attr('rel') + ']').closest('li').addClass('active');});