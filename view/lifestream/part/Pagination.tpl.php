<div id="pagination">
	<p><?= $description ?></p>
	<ul>
<? if(isset($next)) : ?>
		<li><a href="<?= $next ?>" title="More recent activity">newer</a></li>
<? endif ?>
<? if(isset($prev)) : ?>
		<li><a href="<?= $prev ?>" title="View older activity">older</a></li>
<? endif ?>
	</ul>
</div>