<? Loader::load('view', 'waterfalls/part/Header', compact('domain_container', 'main_navigation')) ?>
<div class="inner">
    <div class="clear" id="container">
<? Loader::load('view', "waterfalls/body/{$view}", $data) ?>
    </div>
</div>
<? Loader::load('view', 'waterfalls/part/Bottom', compact('activity_array', 'domain_container')) ?>
<? Loader::load('view', 'common/Footer', $footer) ?>