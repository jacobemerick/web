<div class="bow-tie-container">
  <div class="portfolio-container">
    <?= Loader::load('view', 'portfolio/part/Header', $header_data) ?>
    <div class="window">
      <?= Loader::load('view', "portfolio/body/{$body_view}", $body_data) ?>
    </div>
    <div class="bottom">
      <div class="inner">
        <?= Loader::load('view', 'common/SiteLinks', compact('domain_container')) ?>
        <?= Loader::load('view', 'common/Activity', compact('activity_array', 'domain_container')) ?>
      </div>
    </div>
    <?= Loader::load('view', 'common/Footer', $footer) ?>
  </div>
</div>
