<div id="home-layout">
    <div class="top-banner">
        <div class="photo-holder">
            <img src="<?= $photo->file ?>" alt="<?= $photo->description ?>" height="1200" width="1600">
        </div>
        <div class="welcome">
            <h1>Waterfalls of the Keweenaw Area</h1>
            <p>Howdy! Welcome to my site all about waterfalls in the beautiful Upper Peninsula of Michigan. What started as a simple birthday trip has now stretched from the tip of the Keweenaw to the Huron Mountains and beyond. Here you'll find photos, directions, and general information on two hundred different named drops.</p>
            <a class="action" href="/falls/">View Waterfalls</a>
        </div>
    </div>
</div>
<div class="clear inner" id="container">
    <div class="site-updates home-column">
        <h2>Recent Comments</h2>
        <ul class="comment-list">
<? foreach($comments as $comment) : ?>
            <li>
                <a href="<?= $comment->link ?>">
                    <?= $comment->description ?>
                    <span class="comment-meta">posted by <?= $comment->commenter ?></span>
                </a>
            </li>
<? endforeach ?>
        </ul>
        <h2>Version 2.0</h2>
        <p>This website is a refactor of the initial waterfall project. I'm still in the process of porting over content and functionality. Listed below are some of the most recent updates to this side.</p>
        <dl>
            <dt>July 11</dt>
            <dd>Added 40 new waterfalls to the site</dd>
        </dl>
    </div>
    <div class="log-updates home-column">
        <h2>Recent Logs</h2>
        <p>Here's a list of recently published logs of my adventures.<br />Note: some of these logs are from trips that occurred several years ago and are now just getting pushed live.</p>
        <ul>
<? foreach ($logs as $log) : ?>
            <li>
                <a href="<?= $log->link ?>">
                    <span class="image"><img src="<?= $log->photo->file ?>" alt="<?= $log->photo->description ?>" height="75" width="100" /></span>
                    <span class="log-content">
                        <span class="title"><?= $log->title ?></span>
                        <span class="published">Published <?= $log->date ?></span>
                    </span>
                </a>
            </li>
<? endforeach ?>
        </ul>
    </div>
</div>
