<div class="about" id="container">
<?= Loader::load('view', 'home/Menu', compact('domain_container')) ?>
	<div id="introduction" class="section">
		<div id="description">
			<h1>About Jacob</h1>
			<h3>Introduction</h3>
			<p>My name is Jacob Emerick and I am a young man living in the Phoenix area. I work in the field of software development concentrating on best practices, optimization, and responsible implementation. When not working on code or project management I enjoy hiking and backpacking.</p>
			<h3>History</h3>
			<p>Born in Camp Pendleton the son of two Marines, my early years were spent moving between military bases. We settled down in Port Hope, Michigan for most of my youth, where I was involved in sports, extracurricular academics, and youth groups. I graduated valedictorian of my high school in 2003 and traveled up to Houghton to attend Michigan Technological University. In college I became involved in different student organizations, holding positions within the Undergraduate Student Government, Student Council and the Inter-Residence Hall Council. It took five years, but I earned a degree in Applied &amp; Computational Mathematics with emphasis on Technical Communication and Business Management in the spring of 2008.</p>
			<h3>Web Development</h3>
			<p>During my college years I started getting into web development for different student groups and freelance work. Once I graduated one of the university departments reached out to hire me on full time for web support. When Katie and I moved down to Wisconsin I started working at SparkNET as a PHP programmer, gaining PHP and object-orientated experience, before advancing on to DealerFire as a front-end developer and department manager. I currently work remotely for Shutterstock, a stock photography company in New York, as a backend engineer.</p>
			<h3>Hiking</h3>
			<p>In 2008 I started a simple project to visit every waterfall in the Keweenaw area which kicked off a deep appreciation and understanding of the wilds of the Upper Peninsula. Avoiding trails in both public and state land, I will spend days wandering through woods and climbing mountains. Most of my hikes are in the Huron Mountains and Peshekee Highlands, although I do enjoy trips to the Keweenaw and Ottawa forests.</p>
			<h3>Etc</h3>
			<p>I married the love of my life in 2012, Katie Reynolds (now Emerick), on a beautiful August weekend. While hiking and web development are personal hobbies Katie and I do enjoy a number of interests, including gaming (mostly board/card) and watching Doctor Who (which explains the allons-y reference on the home page). We also have two <em>awesome</em> german shepherd mixes and two <em>quite lame</em> cats. Oh, and two sons, Noah and Thomas.</p>
		</div>
		<div id="sidebar">
			<h3>Quick Stats</h3>
			<dl>
				<dt>Career</dt>
				<dd>Web Development, Data Analysis</dd>
				<dt>Languages</dt>
				<dd>PHP, HTML5, CSS3, Javascript, etc</dd>
				<dt>Employer</dt>
				<dd>Shutterstock</dd>
				<dt>Residence</dt>
				<dd>Phoenix, AZ</dd>
				<dt>Relationship</dt>
				<dd>Married to Katie Emerick</dd>
				<dt>Hobbies</dt>
				<dd>Hiking, gaming, reading</dd>
				<dt>Favorite Book</dt>
				<dd>Frank Herbert's Dune</dd>
				<dt>Favorite Movie</dt>
				<dd>Scott Pilgrim</dd>
				<dt>Three-year Goal</dt>
				<dd>Thru-hike the Appalachian Trail</dd>
			</dl>
		</div>
	</div>
<?= Loader::load('view', 'home/Bottom', compact('domain_container', 'activity_array')) ?>
</div>
<?= Loader::load('view', 'common/Footer', $footer) ?>
