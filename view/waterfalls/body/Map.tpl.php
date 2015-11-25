<div id="map"></div>
<div id="legend">
    <ul id="waterfall-list">
<? foreach($waterfall_list as $waterfall) : ?>
        <li data-coordinate="<?= $waterfall->latitude ?>,<?= $waterfall->longitude ?>"<?= ($waterfall->hide_on_initial_load) ? ' data-initial-ignore="true"' : '' ?> data-link="<?= $waterfall->link ?>" data-image="<?= $waterfall->image ?>" data-image-alt="<?= $waterfall->image_alt ?>" data-waterfall="<?= $waterfall->name ?>" data-river="<?= $waterfall->watercourse ?>"><?= $waterfall->name ?> on <?= $waterfall->watercourse ?></li>
<? endforeach ?>
    </ul>
</div>
