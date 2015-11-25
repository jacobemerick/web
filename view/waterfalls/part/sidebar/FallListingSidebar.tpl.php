<div class="sidebar">
    <h4>Counties</h4>
    <ul>
<? foreach($county_list as $county) : ?>
        <li><a href="<?= $county->uri ?>"><?= $county->name ?> <span class="count"><?= $county->count ?></span></a></li>
<? endforeach ?>
    </ul>
    <h4>River Systems</h4>
    <ul>
<? foreach($watercourse_list as $watercourse) : ?>
        <li><a href="<?= $watercourse->uri ?>"><?= $watercourse->name ?> <span class="count"><?= $watercourse->count ?></span></a></li>
<? endforeach ?>
    </ul>
</div>