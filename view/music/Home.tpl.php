<div id="container">
	<div id="background">
	</div>
	<div id="loading">
	</div>
	<div id="albums">
	</div>
	<div id="click-block"></div>
	<div id="showcase">
		<div id="showcase-image">
		</div>
		<div id="showcase-information">
			<ul>
				<li id="showcase-artist"></li>
				<li id="showcase-album"></li>
			</ul>
		</div>
		<div id="showcase-close">x</div>
	</div>
	<? if(!$supported_browser) : ?>
	<div id="warning">
		<p>I'm sorry, but this site does not support your browser. Please use Firefox, Safari, or Google Chrome to enjoy the coolness.</p>
	</div>
	<? endif ?>
	<div id="welcome" class="<?= ($hide_popup) ? 'down' : 'up' ?>">
		<h1>Welcome to Jacob's Popular Music Page!</h1>
		<p>This is a display of my recently played music, weighted by plays.</p>
		<h2>What?</h2>
		<p>I like listening to music and felt like making some cool to show it. Inspired by the Zune media player, I made this, a weighted display of my recently played albums. Larger albums have been played more times more recently.</p>
		<h2>How?</h2>
		<p>Well, I use the last.fm scrobbling plugin to connect and keep track of what music I listen to on a daily basis. My server pulls this information daily, then does a bunch of calculations based on the date and number of plays to figure out the relative size of each album. These calculations are done in realtime - you can refresh this page and watch the albums pick different locations.</p>
		<h2>Who?</h2>
		<p>My name is Jacob, and I'm a web developer (who also hikes). Check out my <a href="http://home.jacobemerick.com/">home page</a>!</p>
		<div id="welcome-toggle"><?= ($hide_popup) ? '[+] show' : '[-] hide' ?></div>
	</div>
</div>