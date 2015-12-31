<?php

require_once __DIR__ . '/../../bootstrap.php';

use Thepixeldeveloper\Sitemap\Output;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

$entryArray = [
    [
        'path' => '/',
        'lastmod' => new DateTime('first day of this month'),
        'changefreq' => 'month',
        'priority' => 1,
    ],
    [
        'path' => '/terms/',
        'lastmod' => new DateTime('first day of this month'),
        'changefreq' => 'month',
        'priority' => .3,
    ],
    [
        'path' => '/change-log/',
        'lastmod' => new DateTime('first day of this week'),
        'changefreq' => 'weekly',
        'priority' => .1,
    ],
    [
        'path' => '/contact/',
        'lastmod' => new DateTime('first day of this year'),
        'changefreq' => 'yearly',
        'priority' => .6,
    ],
];

$urlSet = new Urlset();
foreach ($entryArray as $entry) {
    $url = new Url('http://site.jacobemerick.com' . $entry['path']);
    $url->setLastMod($entry['lastmod']->format('c'));
    $url->setChangeFreq($entry['changefreq']);
    $url->setPriority($entry['priority']);
    $urlSet->addUrl($url);
}
$output = new Output();
$output->setIndentString('  ');

$tempSitemap = __DIR__ . '/../../../public/site/sitemap-new.xml';
$finalSitemap = __DIR__ . '/../../../public/site/sitemap.xml';

$sitemapHandle = fopen($tempSitemap, 'w');
fwrite($sitemapHandle, $output->getOutput($urlSet));
fclose($sitemapHandle);

rename($tempSitemap, $finalSitemap);
