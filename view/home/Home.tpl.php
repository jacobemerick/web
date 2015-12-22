<div class="home" id="container">
<?= Loader::load('view', 'home/Menu', compact('domain_container')) ?>
	<div id="introduction" class="section">
		<div id="photo-container">
			<img alt="Jacob Emerick, with a bow tie" height="314" width="314" src="/jacob-emerick.jpg" />
		</div>
		<div id="description">
			<h1>Allons-y!</h1>
			<p>My name is Jacob Emerick.</p>
			<p>I am a web developer who focuses on practical, responsible implementation. Also, I enjoy hiking and think <em>bow ties are cool</em>.</p>
			<ul id="social-links">
				<li class="facebook"><a href="https://www.facebook.com/jacobemerick" rel="nofollow" target="_blank" title="Jacob's Facebook profile page">Facebook</a></li>
				<li class="linkedin"><a href="http://www.linkedin.com/in/jacobpemerick" rel="nofollow" target="_blank" title="Professional LinkedIn of Jacob Emerick">LinkedIn</a></li>
				<li class="twitter"><a href="https://twitter.com/jpemeric" rel="nofollow" target="_blank" title="Twitter handle for Jacob's Musings">Twitter</a></li>
			</ul>
		</div>
	</div>
	<div id="blog-updates" class="section">
		<h3>Recent blog posts</h3>
		<a class="read-more" href="<?= $domain_container->blog ?>" title="Visit Jacob's Blog">View all posts&hellip;</a>
		<ul>
<? foreach($post_array as $post) : ?>
			<li>
<? if($post->thumb !== '') : ?>
				<?= $post->thumb ?>
<? endif ?>
				<h5><a href="<?= $post->url ?>" title="<?= "{$post->category} {$post->title}" ?>"><?= $post->title ?></a></h5>
				<?= $post->body ?>
				<a class="read-more" href="<?= $post->url ?>" title="Read more about <?= $post->title ?>">Continue reading&hellip;</a>
			</li>
<? endforeach ?>
		</ul>
	</div>
<?= Loader::load('view', 'home/Bottom', compact('domain_container', 'activity_array')) ?>
</div>
<?= Loader::load('view', 'common/Footer', $footer) ?>