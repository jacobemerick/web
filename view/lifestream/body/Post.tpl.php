<div id="pagination">
	<a class="back-link" href="/<?= $post->type ?>/">&laquo; view all <?= $post->type ?> activities</a>
</div>
<ul id="single-post">
<?= Loader::load('view', 'lifestream/part/Post', compact('post', 'type')) ?>
</ul>