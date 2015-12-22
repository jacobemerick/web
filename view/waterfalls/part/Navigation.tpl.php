<div class="pagination">
	<p><?= $description ?></p>
<? if(count($list) > 0) : ?>
	<ul>
<? foreach($list as $link) : ?>
		<li<?= isset($link->class) ? " class=\"{$link->class}\"" : '' ?>><? if(isset($link->uri)) : ?><a href="<?= $link->uri ?>"><? endif ?><span><?= $link->anchor ?></span><? if(isset($link->uri)) : ?></a><? endif ?></li>
<? endforeach ?>
	</ul>
<? endif ?>
</div>