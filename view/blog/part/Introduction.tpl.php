<div id="introduction">
	<div class="inner">
<? if(isset($image)) : ?>
		<div class="content">
<? endif ?>
			<h1><?= $title ?></h1>
<? if(isset($content)) : ?>
			<p><?= $content ?></p>
<? endif ?>
<? if(isset($image)) : ?>
		</div>
<? endif ?>
<? if(isset($image)) : ?>
		<div id="photo-container"><?= $image ?></div>
<? endif ?>
	</div>
</div>