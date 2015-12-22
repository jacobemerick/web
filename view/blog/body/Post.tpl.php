<div class="post hfeed">
	<div class="post-content hentry">
		<h1 class="entry-title"><a href="<?= $post->path ?>"><?= $post->title ?></a></h1>
		<ul class="meta">
			<li class="category">Category <span><a href="<?= $post->category_link ?>" title="View all posts in <?= $post->category ?>" rel="category tag"><?= $post->category ?></a></span></li>
			<li class="date">Posted <span class="published" title="<?= $post->date->stamp ?>"><time class="dtstart entry-date" datetime="<?= $post->date->stamp ?>" pubdate><?= $post->date->friendly ?></time></span></li>
			<li class="by">by <span class="author vcard"><a rel="author" href="<?= $author_url ?>" class="url" title="Visit Jacob's homepage"><span class="fn"><?= $author ?></span></a></span>
		</ul>
		<div class="entry-content"><?= $post->body ?></div>
	</div>
	<? Loader::load('view', 'blog/part/Series', $series_posts) ?>
	<? Loader::load('view', 'blog/part/ReadMore', compact('related_posts')) ?>
</div>
<? Loader::load('view', 'common/CommentListing', $comment_array) ?>