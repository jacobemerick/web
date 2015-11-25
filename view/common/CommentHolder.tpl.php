<? Loader::load('view', 'common/Comment', compact('comment')) ?>
<? if(isset($comment->replies) && count($comment->replies) > 0) : ?>
<ul class="comment-replies">
<? foreach($comment->replies as $reply_comment) : ?>
	<li id="<?= "comment-{$reply_comment->id}" ?>">
<? Loader::load('view', 'common/Comment', array('comment' => $reply_comment)) ?>
	</li>
<? endforeach ?>
</ul>
<? endif ?>
<span class="comment-reply"><span class="faux-link" onclick="document.getElementById('<?= "comment-form-{$comment->id}" ?>').style.display = 'block'; return true;">Add to this discussion</span></span>
<? Loader::load('view', 'common/CommentForm', compact('comment', 'commenter')) ?>