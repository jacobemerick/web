<div id="container">
	<?= Loader::load('view', 'site/part/Top', $top_data) ?>
	<?= Loader::load('view', 'site/part/LeftSide', $left_side_data) ?>
	<?= Loader::load('view', "site/body/{$body_view}", $body_data) ?>
	<div id="bottom">
		<? Loader::load('view', 'common/SiteLinks', compact('domain_container')) ?>
		<? Loader::load('view', 'common/Activity', compact('activity_array', 'domain_container')) ?>
		<? Loader::load('view', 'common/Footer', $footer) ?>
	</div>
</div>