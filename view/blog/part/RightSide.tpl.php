<div id="right-side">
	<form id="search-form" method="get" name="search" action="/search/" onsubmit="window.location.href = window.location.protocol + '//' + window.location.hostname + '/search/' + document.forms['search']['search'].value.toLowerCase().replace(/[^a-z0-9]/g, '-').replace(/^-*/, '').replace(/-*$/, '').replace(/-+/g, '-') + '/'; return false;">
		<input type="text" name="search" placeholder="Search Posts" />
		<input type="submit" name="submit" value="Submit Search" />
	</form>
	<h4>Tag Cloud</h4>
	<ul class="tag-cloud">
		<? foreach($tags as $tag): ?>
		<li class="size<?= $tag->scalar ?>">
			<a href="<?= $tag->link ?>"><?= $tag->name ?></a>
		</li>
		<? endforeach ?>
	</ul>
	<h4>Recent Comments</h4>
  <? if (empty($comments)) : ?>
  <p>Could not load comments. Please try again later.</p>
  <? else : ?>
	<ul class="comment-list">
		<? foreach($comments as $comment) : ?>
		<li>
			<a href="<?= $comment->link ?>">
				<span class="commenter"><?= $comment->commenter ?>:</span>
				<?= $comment->description ?>
			</a>
		</li>
		<? endforeach ?>
	</ul>
  <? endif ?>
</div>
