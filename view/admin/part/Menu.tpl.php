<div id="menu">
	<ul class="menu">
<? foreach($menu_array as $menu_item) : ?>
		<li<?= ($menu_item->is_active) ? ' class="active"' : '' ?>>
			<a href="<?= $menu_item->link ?>"><?= $menu_item->label ?></a>
<? if(isset($menu_item->submenu)) : ?>
			<ul class="submenu">
<? foreach($menu_item->submenu as $submenu_item) : ?>
				<li><a href="<?= $submenu_item->link ?>"><?= $submenu_item->label ?></a></li>
<? endforeach ?>
			</ul>
<? endif ?>
		</li>
<? endforeach ?>
	</ul>
</div>