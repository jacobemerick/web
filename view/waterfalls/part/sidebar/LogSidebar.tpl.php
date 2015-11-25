<div class="sidebar">
<? if (count($companion_list) > 0) : ?>
    <h4>Companions</h4>
    <ul>
<? foreach($companion_list as $companion) : ?>
        <li><a href="<?= $companion->path ?>"><?= $companion->title ?></a></li>
<? endforeach ?>
    </ul>
<? endif ?>
<? if (count($tag_list) > 0) : ?>
    <h4>Related Tags</h4>
    <ul>
<? foreach($tag_list as $tag) : ?>
        <li><a href="<?= $tag->path ?>"><?= $tag->title ?></a></li>
<? endforeach ?>
    </ul>
<? endif ?>
    <h4>Waterfalls Visited</h4>
    <ul>
<? foreach($waterfall_list as $waterfall) : ?>
        <li><a href="<?= $waterfall->path ?>"><?= $waterfall->title ?></a></li>
<? endforeach ?>
    </ul>
</div>