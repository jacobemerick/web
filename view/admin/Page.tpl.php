<div id="container">

<? Loader::load('view', 'admin/part/Header') ?>
<? Loader::load('view', 'admin/part/Menu', $menu_array) ?>

<div id="content">
<? Loader::load('view', "admin/body/{$view}") ?>
</div>

</div>