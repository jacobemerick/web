<div id="site-links">
	<h4>Some of my Sites</h4>
	<ul>
<? if(URLDecode::getSite() !== 'home') : ?>
		<li><a href="<?= $domain_container->home ?>" title="Jacob Emerick's Home"><span class="title">Home</span> <span class="description">the main site for Jacob Emerick</span></a></li>
<? endif ?>
<? if(URLDecode::getSite() !== 'blog') : ?>
		<li><a href="<?= $domain_container->blog ?>" title="Jacob's Blog about programming and hiking"><span class="title">Blog</span> <span class="description">posts on hiking, web development, and me</span></a></li>
<? endif ?>
		<li><a href="<?= $domain_container->lifestream ?>" title="Combination of Jacob's online activities"><span class="title">Lifestream</span> <span class="description">combination of online tomfoolery</span></a></li>
		<li><a href="<?= $domain_container->map ?>" title="Hiking map of Jacob's wanderings"><span class="title">Map</span> <span class="description">summary of upper peninsula adventures</span></a></li>
		<li><a href="<?= $domain_container->portfolio ?>" title="Jacob's portfolio of programming and design work"><span class="title">Portfolio</span> <span class="description">examples of my previous work</span></a></li>
<? if(URLDecode::getSite() !== 'waterfalls') : ?>
		<li><a href="<?= $domain_container->waterfalls ?>" title="Waterfalls of the Keweenaw"><span class="title">Waterfalls</span> <span class="description">resource of Keweenaw waterfalls</span></a></li>
<? endif ?>
	</ul>
</div>