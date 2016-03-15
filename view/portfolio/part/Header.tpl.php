<div id="header">
	<h3>
		<a href="<?= $home_link ?>">Jacob Emerick's Portfolio</a>
	</h3>
	<ul>
		<? foreach($menu as $item) : ?>
		<li class="<?= ($item->active) ? 'active' : '' ?>">
			<a href="<?= $item->link ?>"><?= $item->name ?></a>
		</li>
		<? endforeach ?>
	</ul>
</div>
