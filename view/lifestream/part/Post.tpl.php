<li class="<?= $post->type ?>">
	<div class="time-container">
		<time class="dtstart" datetime="<?= $post->date->stamp ?>"><?= $post->date->elapsed ?></time>
	</div>
	<div class="post">
<? if($post->type == 'youtube' && strlen($post->embed_code) > 0) : ?>
		<div class="embedded-video-container">
			<?= $post->embed_code ?>
		</div>
<? endif ?>
<? if($post->type == 'blog' && strlen($post->image) > 0) : ?>
		<?= $post->image ?>
<? endif ?>
<? if($post->type == 'book' && strlen($post->image) > 0) : ?>
		<?= $post->image ?>
<? endif ?>
<? if($type == 'list') : ?>
		<h5><?= $post->title ?></h5>
<? elseif($type == 'single') : ?>
		<h1><?= $post->title ?></h1>
<? endif ?>
		<ul class="meta">
			<li class="source">Source: <span><?= $post->type ?></span></li>
			<li class="time">Time: <span><time class="dtstart" datetime="<?= $post->date->stamp ?>"><?= $post->date->friendly ?></time></span></li>
<? if($post->type == 'twitter' && ($post->retweets > 0 || $post->favorites > 0)) : ?>
			<li class="retweets">Interaction: <? if($post->retweets > 0) : ?><span><?= $post->retweets ?> Retweet<?= ($post->retweets > 1) ? 's' : '' ?></span><? endif ?><? if($post->favorites > 0) : ?><span><?= $post->favorites ?> Favorite<?= ($post->favorites > 1) ? 's' : '' ?></span><? endif ?></li>
<? endif ?>
<? if($post->type == 'blog' && $post->comments > 0) : ?>
			<li class="comments">Interaction: <span><?= $post->comments ?> Comment<?= ($post->comments > 1) ? 's' : '' ?></span></li>
<? endif ?>
<? if($type == 'list') : ?>
			<li class="link"><a href="<?= $post->url ?>">Link</a></li>
<? endif ?>
		</ul>
	</div>
</li>