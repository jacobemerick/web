<? if(count($posts) > 0) : ?>
<? if($show_top_navigation) : ?>
<? Loader::load('view', 'blog/part/Navigation', $navigation) ?>
<? endif ?>
<div class="listing">
<? foreach($posts as $post) : ?>
<? Loader::load('view', 'blog/part/PostPreview', compact('domain_container', 'post')) ?>
<? endforeach ?>
</div>
<? Loader::load('view', 'blog/part/Navigation', $navigation) ?>
<? else : ?>
	<p>Sorry, there are no posts that fit your request. Please go back to the <a href="/">main page</a> or try a different search.</p>
<? endif ?>