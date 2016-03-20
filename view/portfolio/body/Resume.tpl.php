<div id="content">
  <div class="hresume resume">
    <div class="contact vcard" id="jacob-contact">
      <img src="<?= $data['basics']['picture'] ?>" alt="<?= $data['basics']['name'] ?>" />
      <h2 class="fn n"><?= $data['basics']['name'] ?></h2>
      <h3 class="title"><?= $data['basics']['label'] ?></h3>
      <hr />
      <ul>
        <li><?= $data['basics']['location']['city'] ?>, <?= $data['basics']['location']['region'] ?></li>
        <li><a class="email" href="mailto:<?= $data['basics']['email'] ?>"><?= $data['basics']['email'] ?></a></li>
        <li><a class="url" href="<?= $data['basics']['website'] ?>"><?= $data['basics']['website'] ?></a></li>
      </ul>
      <hr />
      <ul>
        <?php foreach ($data['basics']['profiles'] as $profile) : ?>
        <li><a href="<?= $profile['url'] ?>"><?= $profile['network'] ?></a></li>
        <?php endforeach ?>
      </ul>
    </div>
    
    <div class="main">
      <h1>Resume</h1>
      <h2>About</h2>
      <p class="summary"><?= $data['basics']['summary'] ?></p>
      <h2>Work Experience</h2>
      <div class="vcalendar">
        <?php foreach ($data['work'] as $work) : ?>
        <div class="experience vevent vcard">
          <div class="htitle">
            <a href="#jacob-contact" class="include" title="Jacob Emerick"></a>
            <span class="title"><?= $work['position'] ?></span>
            <span class="org"><a href="<?= $work['website'] ?>"><?= $work['company'] ?></a></span>
          </div>
          <div class="date_duration">
            <abbr class="dtstart" title="<?= $work['startDate'] ?>"><?= $work['startDate'] ?></abbr> - 
            <?php if (isset($work['endDate'])) : ?>
            <abbr class="dtend" title="<?= $work['endDate'] ?>"><?= $work['endDate'] ?></abbr>
            <?php else : ?>
            Present
            <?php endif ?>
          </div>
          <p class="summary"><?= $work['summary'] ?></p>
          <ul class="highlights">
            <?php foreach ($work['highlights'] as $highlight) : ?>
            <li><?= $highlight ?></li>
            <?php endforeach ?>
          </ul>
        </div>
        <?php endforeach ?>
      </div>
      <h4>Skills</h4>
      <dl class="tags">
        <?php foreach ($data['skills'] as $skill) : ?>
        <dt class="skill"><?= $skill['name'] ?> (<?= $skill['level'] ?>)</dt>
        <dd>
          <ul>
            <?php foreach ($skill['keywords'] as $keyword) : ?>
            <li><?= $keyword ?></li>
            <?php endforeach ?>
          </ul>
        </dd>
        <?php endforeach ?>
      </dl>
      <h4>Education</h4>
      <div class="vcalendar">
        <?php foreach ($data['education'] as $education) : ?>
        <div class="education vevent vcard">
          <div class="htitle">
            <a href="#jacob-contact" class="include" title="Jacob Emerick"></a>
            <span class="summary"><?= $education['area'] ?>, <?= $education['studyType'] ?></span>
            <span class="org"><?= $education['institution'] ?></span>
          </div>
          <div class="date_duration">
            <abbr class="dtstart" title="<?= $education['startDate'] ?>"><?= $education['startDate'] ?></abbr> - 
            <abbr class="dtend" title="<?= $education['endDate'] ?>"><?= $education['endDate'] ?></abbr>
          </div>
        </div>
        <?php endforeach ?>
      </div>
      <h4>Awards</h4>
      <ul>
        <?php foreach ($data['awards'] as $award) : ?>
        <li><?= $award['title'] ?> <?= $award['awarder'] ?></li>
        <li><?= $award['date'] ?></li>
        <li><?= $award['summary'] ?></li>
        <?php endforeach ?>
      </ul>
      <h4>Interests</h4>
      <ul>
        <?php foreach ($data['interests'] as $interest) : ?>
        <li><?= $interest['name'] ?></li>
        <li>
        <?php foreach ($interest['keywords'] as $keyword) : ?><?= $keyword ?> <?php endforeach ?>
        </li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
</div>
