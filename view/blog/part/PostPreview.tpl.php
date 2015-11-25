<div class="post">
	<div class="post-content">
		<h2><a href="<?= $post->path ?>"><?= $post->title ?></a></h2>
<? if($post->image !== '') : ?>
		<div class="photo-container">
			<?= $post->image ?>
		</div>
<? endif ?>
		<?= $post->body ?>
		<ul class="meta">
			<li class="category">Category <span><?= $post->category ?></span></li>
			<li class="date">Posted <span><?= $post->date->friendly ?></span></li>
<? if($post->comment_count > 0) : ?>
			<li class="interaction">Interaction <span><?= $post->comment_count ?> Comment<?= ($post->comment_count > 1) ? 's' : '' ?></span></li>
<? endif ?>
			<li class="read-more"><a href="<?= $post->path ?>">read more</a></li>
		</ul>
	</div>
</div>