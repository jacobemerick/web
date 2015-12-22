<div class="album clear">
    <ul>
<? foreach($album as $photo) : ?>
        <li><a class="photo" href="<?= $photo->full_link ?>" title="<?= $photo->description ?>"><?= $photo->image_node ?></a></li>
<? endforeach ?>
    </ul>
</div>