<div class="contact">
  <h1>Contact Jacob</h1>
<?php if ($success) : ?>
  <p>Thanks for reaching out to me! I'll get back to you as soon as possible. In the meantime, you should totally check out <a href="<?= $domain_container->blog ?>" title="Jacob's blog about hiking and web development">my blog</a>.</p>
<?php else : ?>
  <p>Please feel free to reach out to me if you think we'd be a good match on a project or future opportunity. Or just to drop a line and start a conversation.</p>
  <form method="post" action="<?= $domain_container->portfolio ?>contact/">
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
      <li<?= (isset($errors['message'])) ? ' class="error"' : '' ?>>
        <label for="input-message">Message</label>
        <textarea name="message" id="input-message" rows="3" cols="40"><?= (isset($values['message'])) ? $values['message'] : '' ?></textarea>
        <? if(isset($errors['message'])) : ?>
          <span class="error-message"><?= $errors['message'] ?></span>
        <? endif ?>
      </li>
      <li>
        <input type="submit" name="submit" value="Send!" />
      </li>
    </ul>
  </form>
<?php endif ?>
</div>

<div class="sidebar">
<?php if ($success) : ?>
  <h3>More Options</h3>
  <p>Looking to connect with Jacob through a different medium? He's active on the following networks.</p>
<?php else : ?>
  <h3>Other Methods</h3>
  <p>Don't want to fill out a form? You can always reach out to Jacob through one of these options.</p>
<? endif ?>
  <ul>
    <li><a href="https://twitter.com/jpemeric" target="_blank" title="Twitter handle for Jacob's Musings"><span class="title">Twitter</span> <span class="description">send over a mention</span></a></li>
    <li><a href="http://www.linkedin.com/in/jacobpemerick" target="_blank" title="Professional LinkedIn of Jacob Emerick"><span class="title">LinkedIn</span> <span class="description">connect professionally</span></a></li>
    <li><a href="https://www.facebook.com/jacobemerick" target="_blank" title="Jacob's Facebook profile page"><span class="title">Facebook</span> <span class="description">we could be friends</span></a></li>
  </ul>
</div>
