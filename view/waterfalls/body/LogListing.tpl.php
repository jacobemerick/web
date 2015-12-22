<div id="journal-listing">
<? Loader::load('view', 'waterfalls/part/introduction/ListingIntroduction', $introduction) ?>
    <div class="content">
<? if(count($items) > 0) : ?>
<? Loader::load('view', 'waterfalls/part/Navigation', $navigation) ?>
        <div class="listing">
<? foreach($items as $item) : ?>
<? Loader::load('view', 'waterfalls/part/LogPreview', $item) ?>
<? endforeach ?>
        </div>
<? Loader::load('view', 'waterfalls/part/Navigation', $navigation) ?>
<? else : ?>
        <p>Sorry, there are no logs that fit your request. Please go back to the <a href="/">main page</a> or try a different search.</p>
<? endif ?>
    </div>
<? Loader::load('view', 'waterfalls/part/sidebar/LogListingSidebar', $sidebar) ?>
</div>