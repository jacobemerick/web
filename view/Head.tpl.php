<!DOCTYPE html>
<html<?= (isset($full_page_map) && $full_page_map == true) ? ' class="map-view"' : '' ?>>

<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<meta name="description" content="<?= $description ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta name="keywords" content="<?= $keywords ?>" />
<? if(isset($author)) : ?>
	<meta name="author" content="<?= $author ?>" />
<? endif ?>
<? if(isset($thumbnail)) : ?>
  <meta name="thumbnail" content="<?= $thumbnail ?>" />
<? endif ?>
	<meta name="google-site-verification" content="<?= $google_verification ?>" />
	<meta name="msvalidate.01" content="<?= $bing_verification ?>" />
	<link rel="shortcut icon" href="/favicon.ico" />
<? if(isset($rss_link)) : ?>
	<link rel="alternate" type="application/rss+xml" title="<?= $rss_link['title'] ?>" href="<?= $rss_link['url'] ?>" />
<? endif ?>
<? if(isset($rss_comment_link)) : ?>
	<link rel="alternate" type="application/rss+xml" title="<?= $rss_comment_link['title'] ?>" href="<?= $rss_comment_link['url'] ?>" />
<? endif ?>
<? if(isset($canonical)) : ?>
	<link rel="canonical" href="<?= $canonical ?>" />
<? endif ?>
<? if(isset($next_link)) : ?>
	<link rel="next" href="<?= $next_link ?>" />
<? endif ?>
<? if(isset($previous_link)) : ?>
	<link rel="prev" href="<?= $previous_link ?>" />
<? endif ?>
<? foreach($css_link_array as $link) : ?>
	<link href="<?= $link ?>" type="text/css" rel="stylesheet" />
<? endforeach ?>
<? foreach($js_link_array as $link) : ?>
	<script src="<?= $link ?>" type="text/javascript"></script>
<? endforeach ?>
</head>

<body>
