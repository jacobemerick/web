<div id="content">
	<h2>Drop a line</h2>
	<? if(isset($success_message)) : ?>
		<div class="success-message"><?= $success_message ?></div>
	<? endif ?>
	<form method="post" action="">
		<ul>
			<li<?= (isset($error_message['name'])) ? ' class="error"' : '' ?>>
				<label for="input-name">Your name</label>
				<input type="text" name="name" id="input-name" value="<?= (isset($value['name'])) ? $value['name'] : '' ?>" />
				<? if(isset($error_message['name'])) : ?>
					<span class="error-message"><?= $error_message['name'] ?></span>
				<? endif ?>
			</li>
			<li<?= (isset($error_message['email'])) ? ' class="error"' : '' ?>>
				<label for="input-email">Your email</label>
				<input type="text" name="email" id="input-email" value="<?= (isset($value['email'])) ? $value['email'] : '' ?>" />
				<? if(isset($error_message['email'])) : ?>
					<span class="error-message"><?= $error_message['email'] ?></span>
				<? endif ?>
			</li>
			<li>&nbsp;</li>
			<li<?= (isset($error_message['message'])) ? ' class="error"' : '' ?>>
				<label for="input-message">Message</label>
				<textarea name="message" id="input-message" rows="3" cols="40"><?= (isset($value['message'])) ? $value['message'] : '' ?></textarea>
				<? if(isset($error_message['message'])) : ?>
					<span class="error-message"><?= $error_message['message'] ?></span>
				<? endif ?>
			</li>
			<li>
				<input type="submit" id="input-submit" name="submit" value="Send!" />
			</li>
		</ul>
	</form>
</div>