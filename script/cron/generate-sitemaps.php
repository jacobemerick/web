<?php

require_once __DIR__ . '/../index.php';

use Thepixeldeveloper\Sitemap\Output;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

/**
 * Helper function to build each sitemap
 *
 * @param array  $entries
 * @param string $domain
 * @return boolean
 */
function buildSitemap(array $entries, $domain, $folder) {
    $urlSet = new Urlset();
    foreach ($entries as $path => $entry) {
        $url = new Url("{$domain}{$path}"); // todo better detection of domain by env
        $url->setLastMod($entry['lastmod']); // todo check if exists
        $url->setChangeFreq($entry['changefreq']); // todo check if exists
        $url->setPriority($entry['priority']); // todo check if exists
        $urlSet->addUrl($url);
    }

    $output = new Output();
    $output->setIndentString('  '); // change indentation from 4 to 2 spaces

    $tempSitemap = __DIR__ . "/../../public/{$folder}/sitemap-new.xml";
    $finalSitemap = __DIR__ . "/../../public/{$folder}/sitemap.xml";

    $sitemapHandle = fopen($tempSitemap, 'w');
    fwrite($sitemapHandle, $output->getOutput($urlSet));
    fclose($sitemapHandle);

    rename($tempSitemap, $finalSitemap);
}

// site.jacobemerick.com
$entryArray = [
    '/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'weekly',
        'priority' => 1,
    ],
    '/terms/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'weekly',
        'priority' => .3,
    ],
    '/change-log/' => [
        'lastmod' => (new DateTime('now'))->format('Y-m-d'), // todo lookup based on changelog
        'changefreq' => 'daily',
        'priority' => .1,
    ],
    '/contact/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'weekly',
        'priority' => .6,
    ],
];

buildSitemap($entryArray, 'http://site.jacobemerick.com', 'site');
