<? $errors = (isset($comment)) ? $comment->errors : $errors ?>
<div class="comment-form<?= (count($errors) > 0) ? ' active' : '' ?>" id="<?= (isset($comment)) ? "comment-form-{$comment->id}" : 'comment-form-new' ?>">
<? if(count($errors) > 0) : ?>
	<ul class="errors">
<? foreach($errors as $error) : ?>
		<li><?= $error ?></li>
<? endforeach ?>
	</ul>
<? endif ?>
	<form method="post" action="#<?= (isset($comment)) ? "comment-form-{$comment->id}" : 'comment-form-new' ?>">
		<ul>
			<li class="text"><label for="<?= (isset($comment)) ? "name-{$comment->id}" : 'name-new' ?>">Name (required)</label><input type="text" id="<?= (isset($comment)) ? "name-{$comment->id}" : 'name-new' ?>" name="name" value="<?= (count($errors) > 0) ? Request::getPost('name') : $commenter->name ?>" /></li>
			<li class="text"><label for="<?= (isset($comment)) ? "email-{$comment->id}" : 'email-new' ?>">Email (required, not displayed)</label><input type="email" id="<?= (isset($comment)) ? "email-{$comment->id}" : 'email-new' ?>" name="email" value="<?= (count($errors) > 0) ? Request::getPost('email') : $commenter->email ?>" /></li>
			<li class="text"><label for="<?= (isset($comment)) ? "website-{$comment->id}" : 'website-new' ?>">Website</label><input type="url" id="<?= (isset($comment)) ? "website-{$comment->id}" : 'website-new' ?>" name="website" value="<?= (count($errors) > 0) ? Request::getPost('website') : $commenter->website ?>" /></li>
			<li class="catcher"><input type="text" name="catch" value="" /></li>
			<li><label for="<?= (isset($comment)) ? "body-{$comment->id}" : 'body-new' ?>">Comment</label><textarea id="<?= (isset($comment)) ? "body-{$comment->id}" : 'body-new' ?>" name="comment" cols="50" rows="4"><?= (count($errors) > 0) ? Request::getPost('comment') : '' ?></textarea></li>
			<li class="mini"><p>Basic HTML tags allowed (a, b, i, pre). Comments may be removed if they are deemed inappropriate.</p></li>
			<li>
				<input type="checkbox" id="<?= (isset($comment)) ? "notify-{$comment->id}" : 'notify-new' ?>" name="notify" value="check"<?= (count($errors) > 0 && Request::getPost('notify') == 'check') ? ' checked="checked"' : '' ?> />
				<label for="<?= (isset($comment)) ? "notify-{$comment->id}" : 'notify-new' ?>"> Email me when others comment on this post</label>
			</li>
			<li>
				<input type="hidden" name="type" value="<?= (isset($comment)) ? $comment->id : 'new' ?>" />
				<input type="submit" name="submit" value="Submit Comment" /> or
				<input type="reset" name="reset" value="Discard" onclick="document.getElementById('<?= (isset($comment)) ? "comment-form-{$comment->id}" : 'comment-form-new' ?>').style.display = 'none'; return true;" />
			</li>
		</ul>
	</form>
</div>
