<? if(isset($previous) || isset($next)) : ?>
<div id="series">
	<h3>Series: <?= $title ?></h3>
	<?= $description ?>
	<ul>
		<li class="previous"><? if(isset($previous->url)) : ?>previous post: <a href="<?= $previous->url ?>"><?= $previous->title ?></a><?endif ?></li>
		<li class="next"><? if(isset($next->url)) : ?>next post: <a class="next" href="<?= $next->url ?>"><?= $next->title ?></a><? endif ?></li>
	</ul>
</div>
<? endif ?>