<div id="left-side">
	<h1 class="hidden"><?= $title ?></h1>
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