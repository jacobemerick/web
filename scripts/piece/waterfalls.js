var slideshow_timer = 0;

$(
  	function()
	{
		startAnalytics();
		$('#next_slide,#prev_slide,#slide_name').hide();
		$('#slide_name').html('<a href="'+$('#slide_items img:last').attr('longdesc')+'" title="'+$('#slide_items img:last').attr('alt')+'">'+$('#slide_items img:last').attr('alt')+'</a>');
		$('#next_slide').click(function()
		{
			fader(1);
		});
		$('#prev_slide').click(function()
		{
			fader(-1);
		});
		setInterval('checkTimer()',1000);
		$('#slideshow').mouseover(function()
		{
			slideshow_timer = 10;
			$('#slide_name').fadeIn();
			$('#next_slide').fadeIn();
			$('#prev_slide').fadeIn();
		});
		$('#slideshow').mouseleave(function()
		{
			slideshow_timer = 3;
			$('#slide_name').fadeOut();
			$('#next_slide').fadeOut();
			$('#prev_slide').fadeOut();
		});
	}
);

function checkTimer()
{
	slideshow_timer++;
	if(slideshow_timer==5)
	{
		slideshow_timer = 0;
		fader(1);
	}
}

function fader(step)
{
	$('#slide_name a').fadeOut();
	if(step==1)
		$('#slide_items img:last').fadeOut('normal',function()
		{
			$(this).prependTo('#slide_items').show();
			$('#slide_name').html('<a href="'+$('#slide_items img:last').attr('longdesc')+'" title="'+$('#slide_items img:last').attr('alt')+'">'+$('#slide_items img:last').attr('alt')+'</a>');
		});
	else
		$('#slide_items img:first').hide().appendTo('#slide_items').fadeIn('normal',function()
		{
			$('#slide_name').html('<a href="'+$('#slide_items img:last').attr('longdesc')+'" title="'+$('#slide_items img:last').attr('alt')+'">'+$('#slide_items img:last').attr('alt')+'</a>');
		});
}