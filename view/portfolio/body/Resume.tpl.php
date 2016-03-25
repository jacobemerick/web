<div class="resume h-resume">
  <div class="contact-card h-card p-contact" id="jacob-contact">
    <img class="u-photo" src="/image/jacob-emerick.jpg" alt="<?= $data['basics']['name'] ?>" />
    <div class="contact-content">
      <h2 class="p-name"><?= $data['basics']['name'] ?></h2>
      <h3 class="p-job-title"><?= $data['basics']['label'] ?></h3>
      <hr />
      <ul class="contact-methods">
        <li>
          <span class="p-locality"><?= $data['basics']['location']['city'] ?></span>,
          <span class="p-region"><?= $data['basics']['location']['region'] ?></span>
        </li>
        <li><a class="u-email" href="mailto:<?= $data['basics']['email'] ?>"><?= $data['basics']['email'] ?></a></li>
        <li><a class="u-url" href="<?= $data['basics']['website'] ?>"><?= $data['basics']['website'] ?></a></li>
      </ul>
      <hr />
        <ul class="profiles">
        <?php foreach ($data['basics']['profiles'] as $profile) : ?>
        <li><a href="<?= $profile['url'] ?>"><?= $profile['network'] ?></a></li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>

  <div class="main-pane">
    <h1>Resume</h1>
    <div class="about-block">
      <h2>About</h2>
      <p class="p-summary"><?= $data['basics']['summary'] ?></p>
    </div>
    <div class="work-block">
      <h2>Work Experience</h2>
      <?php foreach ($data['work'] as $work) : ?>
      <div class="p-experience h-event h-card">
        <div class="role p-name">
          <a href="#jacob-contact" class="include" title="Jacob Emerick"></a>
          <span class="job-title p-job-title"><?= $work['position'] ?></span>,
          <span class="u-org"><a href="<?= $work['website'] ?>"><?= $work['company'] ?></a></span>
        </div>
        <div class="duration">
          <abbr class="dt-start" title="<?= $work['startDate'] ?>"><?= $work['startDate'] ?></abbr> - 
          <?php if (isset($work['endDate'])) : ?>
          <abbr class="dt-end" title="<?= $work['endDate'] ?>"><?= $work['endDate'] ?></abbr>
          <?php else : ?>
          Present
          <?php endif ?>
        </div>
        <p class="summary p-summary"><?= $work['summary'] ?></p>
        <ul class="highlights p-description">
          <?php foreach ($work['highlights'] as $highlight) : ?>
          <li><?= $highlight ?></li>
          <?php endforeach ?>
        </ul>
      </div>
      <?php endforeach ?>
    </div>
    <div class="skills-block">
      <h2>Skills</h2>
      <dl>
        <?php foreach ($data['skills'] as $skill) : ?>
        <dt>
          <span class="p-skill"><?= $skill['name'] ?></span>
          <span class="skill-level"><?= $skill['level'] ?></span>
        </dt>
        <dd>
          <ul>
            <?php foreach ($skill['keywords'] as $keyword) : ?>
            <li><?= $keyword ?></li>
            <?php endforeach ?>
          </ul>
        </dd>
        <?php endforeach ?>
      </dl>
    </div>
    <div class="education-block">
      <h2>Education</h2>
      <?php foreach ($data['education'] as $education) : ?>
      <div class="p-education h-event h-card">
        <div class="role p-name">
          <a href="#jacob-contact" class="include" title="Jacob Emerick"></a>
          <span class="degree p-role"><?= $education['area'] ?>, <?= $education['studyType'] ?></span>
          <span class="u-org"><?= $education['institution'] ?></span>
        </div>
        <div class="duration">
          <abbr class="dt-start" title="<?= $education['startDate'] ?>"><?= $education['startDate'] ?></abbr> - 
          <abbr class="dt-end" title="<?= $education['endDate'] ?>"><?= $education['endDate'] ?></abbr>
        </div>
      </div>
      <?php endforeach ?>
    </div>
    <div class="awards-block">
      <h2>Awards</h2>
      <dl>
        <?php foreach ($data['awards'] as $award) : ?>
        <dt>
          <span class="awards-title"><?= $award['title'] ?></span>
          <span class="awarder"><?= $award['awarder'] ?></span>
        </dt>
        <dd>
          <span class="date"><?= $award['date'] ?></span>
          <span class="summary"><?= $award['summary'] ?></span>
        </dd>
        <?php endforeach ?>
      </dl>
    </div>
    <div class="interests-block">
      <h2>Interests</h2>
      <dl>
        <?php foreach ($data['interests'] as $interest) : ?>
        <dt class="p-skill"><?= $interest['name'] ?></dt>
        <dd>
          <ul>
            <?php foreach ($interest['keywords'] as $keyword) : ?>
            <li><?= $keyword ?></li>
            <?php endforeach ?>
          </ul>
        </dd>
        <?php endforeach ?>
      </dl>
    </div>
  </div>
</div>
