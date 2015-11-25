<span class="comment-meta">
	<span class="comment-name">
<? if(strlen($comment->url)) : ?>
		<a href="<?= $comment->url ?>" target="_blank"><?= $comment->name ?></a>
<? else : ?>
		<?= $comment->name ?>
<? endif ?>
	</span>
	<span class="comment-date"><?= $comment->date ?></span>
</span>
<span class="comment-body<?= ($comment->trusted == 0 ? ' pending' : '') ?>"><?= ($comment->trusted == 0 ? 'Pending: ' : '') ?><?= $comment->body ?></span>