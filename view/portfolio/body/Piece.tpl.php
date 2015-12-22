<div id="content">
	<h2><?= $title ?></h2>
	<div class="loading">
		<img id="piece-image" src="<?= $image->link ?>" height="<?= $image->height ?>" width="<?= $image->width ?>" alt="<?= $title ?> Portfolio Image <?= $image->id ?>" rel="<?= $image->id ?>" />
	</div>
	<ul id="thumb-list">
		<? foreach($thumbs as $thumb) : ?>
		<li>
			<img src="<?= $thumb->link ?>" height="<?= $thumb->height ?>" width="<?= $thumb->width ?>" alt="<?= $title ?> Thumb Portfolio Image <?= $image->id ?>" rel="<?= $thumb->id ?>" />
		</li>
		<? endforeach ?>
	</ul>
	<p class="piece-description"><?= $description ?></p>
</div>