<div id="container">
<? Loader::load('view', 'blog/part/Header', compact('domain_container')) ?>
<? if(isset($introduction)) : ?>
<? Loader::load('view', 'blog/part/Introduction', $introduction) ?>
<? endif ?>
	<div class="inner" id="content-wrap">
		<div id="content">
<? Loader::load('view', "blog/body/{$view}", $data) ?>
		</div>
<? Loader::load('view', 'blog/part/RightSide', $right_side) ?>
		<div class="clear"></div>
	</div>
<? Loader::load('view', 'blog/part/Bottom', compact('activity_array', 'domain_container')) ?>
<? Loader::load('view', 'common/Footer', $footer) ?>
</div>