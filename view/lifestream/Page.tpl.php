<div<?= isset($type) ? " class=\"{$type}\"" : '' ?> id="container">
<?= Loader::load('view', 'lifestream/part/Header', compact('domain_container')) ?>
	<div id="introduction">
<? if($data['type'] == 'list' || $data['type'] == 'about') : ?>
		<h1><?= $title ?></h1>
<? elseif($data['type'] == 'single') : ?>
		<h3><?= $title ?></h3>
<? endif ?>
<? if(isset($description)) : ?>
		<p><?= $description ?></p>
<? endif ?>
	</div>
	<div id="content">
<?= Loader::load('view', "lifestream/body/{$view}", $data) ?>
	</div>
	<div id="sidebar">
<?= Loader::load('view', 'lifestream/part/Sidebar', compact('domain_container')) ?>
	</div>
<?= Loader::load('view', 'common/Footer', $footer) ?>
</div>