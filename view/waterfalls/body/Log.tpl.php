<div id="log" class="hentry">
<? Loader::load('view', 'waterfalls/part/introduction/LogIntroduction', $introduction) ?>
    <div class="content">
        <div class="entry-content"><?= $body ?></div>
<? if (count($album) > 0) : ?>
        <h4>Trip Photos</h4>
<? Loader::load('view', 'waterfalls/part/Album', compact('album')) ?>
<? endif ?>
<? Loader::load('view', 'waterfalls/part/LogSeries', $series) ?>
<? Loader::load('view', 'common/CommentListing', $comment_array) ?>
    </div>
<? Loader::load('view', 'waterfalls/part/sidebar/LogSidebar', $sidebar) ?>
</div>
