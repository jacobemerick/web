<ul class="tags">
	<li>Tags:</li>
<? $tag_count = count($tags) ?>
<? foreach($tags as $key => $tag) : ?>
	<li><a href="<?= $tag->link ?>"><?= $tag->name ?></a><?= ($key < ($tag_count - 1)) ? ',' : '' ?> </li>
<? endforeach ?>
</ul>
