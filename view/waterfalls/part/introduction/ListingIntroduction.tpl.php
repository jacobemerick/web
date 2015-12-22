<div class="introduction callout clear">
<? if (isset($image)) : ?>
    <div class="panel">
<? endif ?>
        <h1><?= $title ?></h1>
<? if(isset($description)) : ?>
        <p><?= $description ?></p>
<? endif ?>
<? if (isset($image)) : ?>
    </div>
<? endif ?>
<? if (isset($image)) : ?>
    <div class="photo"><?= $image ?></div>
<? endif ?>
</div>