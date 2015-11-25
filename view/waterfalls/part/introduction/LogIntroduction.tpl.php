<div class="introduction callout clear">
    <div class="panel">
        <h1 class="entry-title"><a href="<?= $url ?>"><?= $title ?></a></h1>
        <h2 class="h-event">travel log from <time class="dtstart" datetime="<?= $date->stamp ?>"><?= $date->friendly ?></time></h2>
        <p class="entry-summary"><?= $introduction ?> <span class="meta">published on <time class="dtstart" datetime="<?= $publish_date->stamp ?>"><?= $publish_date->friendly ?></time> by <span class="vcard author"><a rel="author" href="<?= $author_url ?>" class="fn url" title="Visit Jacob's homepage"><?= $author ?></a></span></p>
    </div>
    <div class="photo"><?= $image ?></div>
</div>