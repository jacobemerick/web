<div id="waterfall" class="hentry">
<? Loader::load('view', 'waterfalls/part/introduction/FallIntroduction', $introduction) ?>
    <div class="content">
        <div class="photo photo-container"><?= $main_photo ?></div>
<? Loader::load('view', 'waterfalls/part/Album', compact('album')) ?>
        <div class="entry-content">
            <div class="description"><?= $body ?></div>
            <h3>Directions</h3>
            <div class="directions"><?= $directions ?></div>
        </div>
<? Loader::load('view', 'common/CommentListing', $comment_array) ?>
    </div>
<? Loader::load('view', 'waterfalls/part/sidebar/FallSidebar', $sidebar) ?>
</div>