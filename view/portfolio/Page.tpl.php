<div class="portfolio-container">
	<?= Loader::load('view', 'portfolio/part/Header', $header_data) ?>
  <div class="window">
  	<?= Loader::load('view', "portfolio/body/{$body_view}", compact('body_data', 'domain_container')) ?>
  </div>
	<?= Loader::load('view', 'common/Footer', $footer) ?>
</div>
