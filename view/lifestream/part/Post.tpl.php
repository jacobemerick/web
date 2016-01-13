<li class="<?= $post->type ?>">
	<div class="time-container">
		<time class="dtstart" datetime="<?= $post->date->stamp ?>"><?= $post->date->elapsed ?></time>
	</div>
	<div class="post">
    <?= $post->title ?>
		<ul class="meta">
			<li class="source">Source: <span><?= $post->type ?></span></li>
			<li class="time">Time: <span><time class="dtstart" datetime="<?= $post->date->stamp ?>"><?= $post->date->friendly ?></time></span></li>
<? if($post->type == 'twitter' && (!empty($post->retweets) || !empty($post->favorites))) : ?>
			<li class="retweets">Interaction: <? if(!empty($post->retweets)) : ?><span><?= $post->retweets ?> Retweet<?= ($post->retweets > 1) ? 's' : '' ?></span><? endif ?><? if(!empty($post->favorites)) : ?><span><?= $post->favorites ?> Favorite<?= ($post->favorites > 1) ? 's' : '' ?></span><? endif ?></li>
<? endif ?>
<? if($post->type == 'blog' && !empty($post->comments)) : ?>
			<li class="comments">Interaction: <span><?= $post->comments ?> Comment<?= ($post->comments > 1) ? 's' : '' ?></span></li>
<? endif ?>
<? if($type == 'list') : ?>
			<li class="link"><a href="<?= $post->url ?>">Link</a></li>
<? endif ?>
		</ul>
	</div>
</li>
