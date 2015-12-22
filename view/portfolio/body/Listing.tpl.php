<div id="content">
	<h2><?= $title ?></h2>
	<ul>
		<? foreach($pieces as $piece) : ?>
		<li class="piece-link">
			<a href="<?= $piece->url ?>">
				<span class="outer-clip">
					<span class="inner-clip">
						<img src="<?= $piece->image ?>" height="210" width="480" alt="<?= $piece->title ?>" />
					</span>
				</span>
				<span class="piece-title"><?= $piece->title ?></span>
			</a>
		</li>
		<? endforeach ?>
	</ul>
</div>