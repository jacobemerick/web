<div id="content">
	<h2>List of recent changes made to my sites including fixes, features, and more.</h2>
	<ul>
<? $last_displayed_date = '' ?>
<? foreach($changelog as $change) : ?>
		<li>
<? if($change->date->short != $last_displayed_date) : ?>
			<span class="date">
				<time class="dtstart" datetime="<?= $change->date->stamp ?>" title="<?= $change->date->friendly ?>"><?= $change->date->short ?></time>
			</span>
<? endif ?>
			<span class="message"><?= $change->message ?></span>
		</li>
<? $last_displayed_date = $change->date->short ?>
<? endforeach ?>
	</ul>
</div>