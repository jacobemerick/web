<div id="left-side">
	<ul>
<? foreach($menu as $item) : ?>
		<li>
			<a class="<?= ($item->is_active) ? 'active' : '' ?>" href="<?= $item->uri ?>"><?= $item->name ?></a>
		</li>
<? endforeach ?>
	</ul>
</div>