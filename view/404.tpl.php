<div id="container">
	<h1>404</h1>
	<h2>Page Not Found</h2>
	<p>I'm sorry, but the page you requested wasn't found. Below is a list of sites that might help you out.</p>
	<ul>
		<? foreach($site_list as $site) : ?>
		<li>
			<a href="<?= $site['url'] ?>" title="<?= $site['title'] ?>"><?= $site['name'] ?></a>
		</li>
		<? endforeach ?>
	</ul>
</div>
<?= Loader::load('view', 'common/Footer', $footer) ?>