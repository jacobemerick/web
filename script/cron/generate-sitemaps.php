<?php

require_once __DIR__ . '/../index.php';

use Thepixeldeveloper\Sitemap\Output;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

use Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository as BlogPostRepository;
use Jacobemerick\Web\Domain\Blog\Tag\MysqlTagRepository as BlogTagRepository;

/**
 * Helper function to build each sitemap
 *
 * @param array  $entries
 * @param string $domain
 * @return boolean
 */
$buildSitemap = function (array $entries, $domain, $folder) {
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
};


/*********************************************
 * blog.jacobemerick.com
 *********************************************/
$reduceToMostRecentBlogPost = function ($recentPost, $post) {
    if (is_null($recentPost)) {
        return $post;
    }
    $postDate = new DateTime($post['date']);
    $recentPostDate = new DateTime($recentPost['date']);
    return ($postDate > $recentPostDate) ? $post: $recentPost;
};

$blogPostsPerPage = 10;

$blogPostRepository = new BlogPostRepository($container['db_connection_locator']);
$activeBlogPosts = $blogPostRepository->getActivePosts();
$mostRecentBlogPost = array_reduce($activeBlogPosts, $reduceToMostRecentBlogPost);

// todo these post-level dates should be accurate to H:i:s
$entryArray = [
    '/' => [
        'lastmod' => (new DateTime($mostRecentBlogPost['date']))->format('Y-m-d'),
        'changefreq' => 'daily',
        'priority' => .9,
    ]
];
for ($i = 2; (($i - 1) * $blogPostsPerPage) < count($activeBlogPosts); $i++) {
    $entryKey = "/{$i}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime($mostRecentBlogPost['date']))->format('Y-m-d'),
            'changefreq' => 'daily',
            'priority' => .1,
        ]
    ];
}

$blogCategoryArray = [
    'hiking',
    'personal',
    'web-development',
];

foreach ($blogCategoryArray as $blogCategory) {
    $blogCategoryPosts = array_filter($activeBlogPosts, function ($post) use ($blogCategory) {
        return $post['category'] == $blogCategory;
    });
    $mostRecentBlogCategoryPost = array_reduce($blogCategoryPosts, $reduceToMostRecentBlogPost);

    $entryKey = "/{$blogCategory}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime($mostRecentBlogCategoryPost['date']))->format('Y-m-d'),
            'changefreq' => 'daily',
            'priority' => .3,
        ]
    ];

    for ($i = 2; (($i - 1) * $blogPostsPerPage) < count($blogCategoryPosts); $i++) {
        $entryKey = "/{$blogCategory}/{$i}/";
        $entryArray += [
            $entryKey => [
                'lastmod' => (new DateTime($mostRecentBlogCategoryPost['date']))->format('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => .1,
            ]
        ];
    }
}

$blogTagRepository = new BlogTagRepository($container['db_connection_locator']);
$blogTags = $blogTagRepository->getAllTags();
foreach ($blogTags as $blogTag) {
    $blogPostsWithTag = $blogPostRepository->getActivePostsByTag($blogTag['id']);
    if (count($blogPostsWithTag) < 1) {
        continue;
    }

    $mostRecentBlogTagPost = array_reduce($blogPostsWithTag, $reduceToMostRecentBlogPost);

    $blogTagPath = str_replace(' ', '-', $blogTag['tag']);
    $entryKey = "/tag/{$blogTagPath}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime($mostRecentBlogTagPost['date']))->format('Y-m-d'),
            'changefreq' => 'daily',
            'priority' => .1,
        ]
    ];

    for ($i = 2; (($i - 1) * $blogPostsPerPage) < count($blogPostsWithTag); $i++) {
        $blogTagPath = str_replace(' ', '-', $blogTag['tag']);
        $entryKey = "/tag/{$blogTagPath}/{$i}/";
        $entryArray += [
            $entryKey => [
                'lastmod' => (new DateTime($mostRecentBlogTagPost['date']))->format('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => .1,
            ]
        ];
    }
}

$reversedBlogPosts = array_reverse($activeBlogPosts);
foreach ($reversedBlogPosts as $blogPost) {
    $entryKey = "/{$blogPost['category']}/{$blogPost['path']}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime($blogPost['date']))->format('Y-m-d'), // todo this should be based on comment
            'changefreq' => 'weekly',
            'priority' => .8,
        ],
    ];
}

$entryArray += [
    '/about/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'monthly',
        'priority' => .2,
    ]
];

$buildSitemap($entryArray, 'http://blog.jacobemerick.com', 'blog');


/*********************************************
 * home.jacobemerick.com
 *********************************************/
$blogPostRepository = new BlogPostRepository($container['db_connection_locator']);
$mostRecentPost = $blogPostRepository->getActivePosts(1);

$entryArray = [
    '/' => [
        'lastmod' => (new DateTime($mostRecentPost['date']))->format('Y-m-d'),
        'changefreq' => 'daily',
        'priority' => 1,
    ],
    '/about/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'monthly',
        'priority' => .4,
    ],
    '/contact/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'monthly',
        'priority' => .3,
    ],
];

$buildSitemap($entryArray, 'http://site.jacobemerick.com', 'site');


/*********************************************
 * site.jacobemerick.com
 *********************************************/
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

$buildSitemap($entryArray, 'http://site.jacobemerick.com', 'site');
