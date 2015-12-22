<div class="navigation">
	<p><?= $description ?></p>
<? if($prev) : ?>
	<span class="prev">
		<a href="<?= $prev ?>">prev</a>
	</span>
<? endif ?>
<? if($next) : ?>
	<span class="next">
		<a href="<?= $next ?>">next</a>
	</span>
<? endif ?>
</div>