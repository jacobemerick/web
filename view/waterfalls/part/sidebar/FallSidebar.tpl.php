<div class="sidebar">
    <h4>Waterfall Details</h4>
    <dl>
        <dt>Name</dt>
        <dd><?= $name ?></dd>
        <dt>Rating</dt>
        <dd class="rating rate-<?= $rating ?>" title="<?= $rating_display ?>"><span><?= $rating_display ?></span></dd>
<? if ($watercourse != $main_watercourse->name) : ?>
        <dt>River</dt>
        <dd><?= $watercourse ?></dd>
        <dt>River System</dt>
        <dd><a href="/<?= $main_watercourse->alias ?>/" title="<?= $main_watercourse->title ?>"><?= $main_watercourse->name ?></a></dd>
<? else : ?>
        <dt>River System</dt>
        <dd><a href="/<?= $main_watercourse->alias ?>/" title="<?= $main_watercourse->title ?>"><?= $main_watercourse->name ?></a></dd>
<? endif ?>
    </dl>
    <dl>
        <dt>Height</dt>
        <dd><?= $height ?></dd>
        <dt>Width</dt>
        <dd><?= $width ?></dd>
<? if ($drop_count > 1) : ?>
        <dt>Tallest Drop</dt>
        <dd><?= $drop_height ?></dd>
        <dt># of Drops</dt>
        <dd><?= $drop_count ?></dd>
<? endif ?>
    </dl>
    <div class="location-chunk">
        <dl>
            <dt>County</dt>
            <dd><a href="/<?= $county->alias ?>/" title="<?= $county->title ?>"><?= $county->name ?></a></dd>
            <dt>Closest Town</dt>
            <dd><?= $nearest_town ?></dd>
            <dt>Location</dt>
            <dd><?= $latitude ?>, <?= $longitude ?></dd>
            <dt>Elevation</dt>
            <dd><?= $elevation ?></dd>
        </dl>
        <a class="map" href="<?= $map->uri ?>" title="<?= $map->title ?>"><?= $map->image ?></a>
    </div>
<? if (count($journal_list) > 0) : ?>
    <h4>Journal Entries</h4>
    <ul class="journal-list">
<? foreach ($journal_list as $entry) : ?>
        <li><a href="<?= $entry->url ?>"><span class="title"><?= $entry->title ?></span> <span class="date"><?= $entry->date ?></span></a></li>
<? endforeach ?>
    </ul>
<? endif ?>
<? if (count($nearby_list) > 0) : ?>
    <h4>Nearby Waterfalls</h4>
    <ul class="waterfall-list">
<? foreach ($nearby_list as $waterfall) : ?>
        <li><a href="<?= $waterfall->url ?>" title="<?= $waterfall->title ?>"><span class="title"><?= $waterfall->anchor ?></span> <span class="distance"><?= $waterfall->distance ?></span></a></li>
<? endforeach ?>
    </ul>
<? endif ?>
</div>