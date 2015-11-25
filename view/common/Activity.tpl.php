<div id="activity-feed">
	<h4>Activity Stream</h4>
	<ul>
<? foreach($activity_array as $activity) : ?>
		<li><?= $activity->title ?><span class="meta"><time class="dtstart" datetime="<?= $activity->date->stamp ?>" title="<?= $activity->date->friendly ?>"><?= $activity->date->elapsed ?></time></span></li>
<? endforeach ?>
	</ul>
	<a href="<?= $domain_container->lifestream ?>" class="read-more">View more activities&hellip;</a>
</div>