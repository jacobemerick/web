<div id="read-more">
<? if(isset($related_posts)) : ?>
	<h3>Related Posts</h3>
	<ul class="related-posts">
<? foreach($related_posts as $post) : ?>
		<li>
<? if($post->thumb !== '') : ?>
			<?= $post->thumb ?>
<? endif ?>
			<h6><a href="<?= $post->url ?>" title="<?= "{$post->category} {$post->title}" ?>"><?= $post->title ?></a></h6>
			<?= $post->body ?>
			<a class="read-more" href="<?= $post->url ?>" title="Read more about <?= $post->title ?>">Continue reading&hellip;</a>
		</li>
<? endforeach ?>
	</ul>
<? endif ?>
<? if(isset($series_posts)) : ?>
	<ul class="series-posts">
		<? foreach($tags as $tag) : ?>
		<li>
			<a href="<?= $tag->link ?>"><?= $tag->name ?></a>
		</li>
		<? endforeach ?>
	</ul>
<? endif ?>
</div>