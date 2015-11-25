<div class="series">
    <ul>
        <li class="previous"><? if(isset($previous->path)) : ?>previous: <a href="<?= $previous->path ?>"><?= $previous->title ?></a><?endif ?></li>
        <li class="next"><? if(isset($next->path)) : ?>next: <a class="next" href="<?= $next->path ?>"><?= $next->title ?></a><? endif ?></li>
    </ul>
</div>