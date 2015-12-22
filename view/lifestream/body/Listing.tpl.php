<?= Loader::load('view', 'lifestream/part/Pagination', $pagination) ?>
<ul>
<? foreach($posts as $post) : ?>
<?= Loader::load('view', 'lifestream/part/Post', compact('post', 'type')) ?>
<? endforeach ?>
</ul>
<?= Loader::load('view', 'lifestream/part/Pagination', $pagination) ?>