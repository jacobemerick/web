<div class="introduction">
	<h1>Contact Jacob</h1>
</div>
<div class="content">
<? if($form_container->display == 'error') : ?>
		<p>It appears that there were some problems with your submission. Please review the highlighted fields below and try again.</p>
<? elseif($form_container->display == 'success') : ?>
		<p>Thanks for reaching out to me! I'll get back to you as soon as possible. In the meantime, you should totally check out <a href="<?= $domain_container->blog ?>" title="Jacob's blog about hiking and web development">my blog</a>.</p>
<? else : ?>
		<p>Please feel free to contact me with any questions. Just use the form below or any of the other methods listed on this page.</p>
<? endif ?>
<? if($form_container->display != 'success') : ?>
		<form id="contact-form" method="post" action="/contact/">
			<dl>
				<dt><label for="form-name">Your name</label><?= ($form_container->display == 'error' && isset($form_container->messages['name'])) ? ' <span class="message">' . $form_container->messages['name'] . '</span>' : '' ?></dt>
				<dd><input<?= ($form_container->display == 'error' && isset($form_container->messages['name'])) ? ' class="error"' : '' ?> id="form-name" name="name" type="text" value="<?= ($form_container->display == 'error') ? $form_container->values->name : '' ?>" /></dd>
				<dt><label for="form-email">Your email</label><?= ($form_container->display == 'error' && isset($form_container->messages['email'])) ? ' <span class="message">' . $form_container->messages['email'] . '</span>' : '' ?></dt>
				<dd><input<?= ($form_container->display == 'error' && isset($form_container->messages['email'])) ? ' class="error"' : '' ?> id="form-email" name="email" type="email" value="<?= ($form_container->display == 'error') ? $form_container->values->email : '' ?>" /></dd>
				<dt><label for="form-message">Message</label><?= ($form_container->display == 'error' && isset($form_container->messages['message'])) ? ' <span class="message">' . $form_container->messages['message'] . '</span>' : '' ?></dt>
				<dd><textarea<?= ($form_container->display == 'error' && isset($form_container->messages['message'])) ? ' class="error"' : '' ?> id="form-message" name="message" rows="3" cols="30"><?= ($form_container->display == 'error') ? $form_container->values->message : '' ?></textarea></dd>
				<dt>&nbsp;</dt>
				<dd><input name="submit" type="submit" value="Send Message!" /></dd>
			</dl>
		</form>
<? endif ?>
	</div>
	<div id="sidebar">
<? if($form_container->display == 'success') : ?>
		<h3>More Options</h3>
		<p>Looking to connect with Jacob through a different medium? He's (fairly) active on the following networks.</p>
<? else : ?>
		<h3>Other Means</h3>
		<p>Don't want to fill out the form? You can always reach out to Jacob through one of these methods.</p>
<? endif ?>
		<ul>
			<li><a href="https://twitter.com/jpemeric" target="_blank" title="Twitter handle for Jacob's Musings">Twitter</a></li>
			<li><a href="https://www.facebook.com/jacobemerick" target="_blank" title="Jacob's Facebook profile page">Facebook</a></li>
		</ul>
	</div>
