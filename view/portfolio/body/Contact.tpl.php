<div id="content">
	<h2>Drop a line</h2>
	<? if(isset($success)) : ?>
		<div class="success-message"><?= $success?></div>
  <? endif ?>
	<form method="post" action="">
		<ul>
			<li<?= (isset($errors['name'])) ? ' class="error"' : '' ?>>
				<label for="input-name">Your name</label>
				<input type="text" name="name" id="input-name" value="<?= (isset($values['name'])) ? $values['name'] : '' ?>" />
				<? if(isset($errors['name'])) : ?>
					<span class="error-message"><?= $errors['name'] ?></span>
				<? endif ?>
			</li>
			<li<?= (isset($errors['email'])) ? ' class="error"' : '' ?>>
				<label for="input-email">Your email</label>
				<input type="text" name="email" id="input-email" value="<?= (isset($values['email'])) ? $values['email'] : '' ?>" />
				<? if(isset($errors['email'])) : ?>
					<span class="error-message"><?= $errors['email'] ?></span>
				<? endif ?>
			</li>
			<li>&nbsp;</li>
			<li<?= (isset($errors['message'])) ? ' class="error"' : '' ?>>
				<label for="input-message">Message</label>
				<textarea name="message" id="input-message" rows="3" cols="40"><?= (isset($values['message'])) ? $values['message'] : '' ?></textarea>
				<? if(isset($errors['message'])) : ?>
					<span class="error-message"><?= $errors['message'] ?></span>
				<? endif ?>
			</li>
			<li>
				<input type="submit" id="input-submit" name="submit" value="Send!" />
			</li>
		</ul>
	</form>
</div>
