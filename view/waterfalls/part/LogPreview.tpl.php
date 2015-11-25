<div class="item log-pane clear">
    <a class="photo" href="<?= $path ?>"><?= $image ?></a>
    <div class="title">
        <h2><a href="<?= $path ?>"><?= $title ?></a></h2>
        <h4><time class="dtstart" datetime="<?= $date->stamp ?>"><?= $date->friendly ?></time><?= ($comment_count > 0) ? (($comment_count == 1) ? " - {$comment_count} comment" : " - {$comment_count} comments") : '' ?></h4>
        <p><?= $introduction ?></p>
        <ul class="falls">
<? foreach($waterfall_list as $waterfall) : ?>
            <li><?= $waterfall->name ?></li>
<? endforeach ?>
    </div>
</div>