<div id="container">
	<?= Loader::load('view', 'portfolio/part/LeftSide', $left_side_data) ?>
	<?= Loader::load('view', "portfolio/body/{$body_view}", $body_data) ?>
	<?= Loader::load('view', 'common/Footer', $footer) ?>
</div>