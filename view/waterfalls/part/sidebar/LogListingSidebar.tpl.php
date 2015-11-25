<div class="sidebar">
    <h4>Companions</h4>
    <ul>
<? foreach($companion_list as $companion) : ?>
        <li><a href="<?= $companion->uri ?>"><?= $companion->name ?> <span class="count"><?= $companion->count ?></span></a></li>
<? endforeach ?>
    </ul>
    <h4>Period</h4>
    <ul>
<? foreach($period_list as $period) : ?>
        <li><a href="<?= $period->uri ?>"><?= $period->name ?> <span class="count"><?= $period->count ?></span></a></li>
<? endforeach ?>
    </ul>
</div>