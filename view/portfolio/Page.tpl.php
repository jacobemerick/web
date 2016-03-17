<div class="portfolio-container">
	<?= Loader::load('view', 'portfolio/part/Header', $header_data) ?>
  <div class="window">
  	<?= Loader::load('view', "portfolio/body/{$body_view}", $body_data) ?>
  </div>
	<?= Loader::load('view', 'common/Footer', $footer) ?>
</div>
