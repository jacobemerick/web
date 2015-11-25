<div id="comments">
	<h3>Comments (<?= $comment_count ?>)</h3>
	<ul class="comment-listing">
<? foreach($comments as $comment) : ?>
		<li id="<?= "comment-{$comment->id}" ?>">
<? Loader::load('view', 'common/CommentHolder', compact('comment', 'commenter')) ?>
		</li>
<? endforeach ?>
		<li id="comment-new">
			<span class="comment-new"><span class="faux-link" onclick="document.getElementById('comment-form-new').style.display = 'block'; return true;">Add a comment</span></span>
<? Loader::load('view', 'common/CommentForm', compact('commenter', 'errors')) ?>
		</li>
	</ul>
</div>