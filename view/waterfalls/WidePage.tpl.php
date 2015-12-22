<? Loader::load('view', 'waterfalls/part/Header', compact('domain_container', 'main_navigation')) ?>
<? Loader::load('view', "waterfalls/body/{$view}", $data) ?>
<? if ($view !== 'Map') : ?>
<? Loader::load('view', 'waterfalls/part/Bottom', compact('activity_array', 'domain_container')) ?>
<? Loader::load('view', 'common/Footer', $footer) ?>
<? endif ?>