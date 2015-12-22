<div class="clear" id="header">
    <div class="inner">
        <div id="logo">
            <h3><a href="/"><span class="title">Waterfalls</span> <span class="description">of the Keweenaw Area</span></a></h3>
        </div>
        <ul id="navigation">
<? foreach ($main_navigation as $link) : ?>
            <li><a<? if ($link->is_active) : ?> class="active"<? endif ?> href="<?= $link->uri ?>"><?= $link->anchor ?></a></li>
<? endforeach ?>
        </ul>
    </div>
</div>