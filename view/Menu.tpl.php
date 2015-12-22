<div id="menu-wrapper">
	<div id="menu">
		<ul>
			<? foreach($home as $option) : ?>
			<li>
				<a href="<?= $option->link ?>" class="<?= $option->class ?>">
					<?= $option->name ?>
				</a>
			</li>
			<? endforeach ?>
			<? foreach($primary as $option) : ?>
			<li>
				<a href="<?= $option->link ?>" class="<?= $option->class ?>">
					<?= $option->name ?>
				</a>
			</li>
			<? endforeach ?>
			<li class="drop-li">
				<a href="javascript:void(0)" class="down">
					More
				</a>
				<div class="menu-dropdown-holder">
					<ul class="menu-dropdown">
						<? foreach($secondary as $option) : ?>
						<li>
							<a href="<?= $option->link ?>" class="<?= $option->class ?>">
								<?= $option->name ?>
							</a>
						</li>
						<? endforeach ?>
					</ul>
				</div>
			</li>
	</div>
</div>