<?php

require_once __DIR__ . '/../index.php';

use Thepixeldeveloper\Sitemap\Output;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

use Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository as BlogPostRepository;
use Jacobemerick\Web\Domain\Blog\Tag\MysqlTagRepository as BlogTagRepository;
use Jacobemerick\Web\Domain\Portfolio\Piece\MysqlPieceRepository as PortfolioPieceRepository;
use Jacobemerick\Web\Domain\Stream\Post\MysqlPostRepository as StreamPostRepository;
use Jacobemerick\Web\Domain\Waterfall\Companion\MysqlCompanionRepository as WaterfallCompanionRepository;
use Jacobemerick\Web\Domain\Waterfall\County\MysqlCountyRepository as WaterfallCountyRepository;
use Jacobemerick\Web\Domain\Waterfall\Log\MysqlLogRepository as WaterfallLogRepository;
use Jacobemerick\Web\Domain\Waterfall\Period\MysqlPeriodRepository as WaterfallPeriodRepository;
use Jacobemerick\Web\Domain\Waterfall\Watercourse\MysqlWatercourseRepository as WaterfallWatercourseRepository;
use Jacobemerick\Web\Domain\Waterfall\Waterfall\MysqlWaterfallRepository as WaterfallRepository;


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
$mostRecentPost = current($mostRecentPost);

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

$buildSitemap($entryArray, 'http://home.jacobemerick.com', 'home');


/*********************************************
 * lifestream.jacobemerick.com
 *********************************************/
$reduceToMostRecentStreamPost = function ($recentPost, $post) {
    if (is_null($recentPost)) {
        return $post;
    }
    $postDate = new DateTime($post['date']);
    $recentPostDate = new DateTime($recentPost['date']);
    return ($postDate > $recentPostDate) ? $post: $recentPost;
};

$streamPostsPerPage = 15;

$streamPostRepository = new StreamPostRepository($container['db_connection_locator']);
$streamPosts = $streamPostRepository->getPosts();
$mostRecentStreamPost = array_reduce($streamPosts, $reduceToMostRecentStreamPost);

$entryArray = [
    '/' => [
        'lastmod' => (new DateTime($mostRecentStreamPost['date']))->format('c'),
        'changefreq' => 'hourly',
        'priority' => .9,
    ]
];
for ($i = 2; (($i - 1) * $streamPostsPerPage) < count($streamPosts); $i++) {
    $entryKey = "/page/{$i}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime($mostRecentStreamPost['date']))->format('c'),
            'changefreq' => 'hourly',
            'priority' => .1,
        ]
    ];
}

$streamTypeArray = [
    'blog',
    'books',
    'distance',
    'hulu',
    'twitter',
    'youtube',
];

foreach ($streamTypeArray as $streamType) {
    $streamTypePosts = array_filter($streamPosts, function ($post) use ($streamType) {
        return $post['type'] == $streamType;
    });
    $mostRecentStreamTypePost = array_reduce($streamTypePosts, $reduceToMostRecentStreamPost);

    $entryKey = "/{$streamType}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime($mostRecentStreamTypePost['date']))->format('c'),
            'changefreq' => 'hourly',
            'priority' => .3,
        ]
    ];

    for ($i = 2; (($i - 1) * $streamPostsPerPage) < count($streamTypePosts); $i++) {
        $entryKey = "/{$streamType}/page/{$i}/";
        $entryArray += [
            $entryKey => [
                'lastmod' => (new DateTime($mostRecentStreamTypePost['date']))->format('c'),
                'changefreq' => 'hourly',
                'priority' => .1,
            ]
        ];
    }
}

$reversedStreamPosts = array_reverse($streamPosts);
foreach ($reversedStreamPosts as $streamPost) {
    $entryKey = "/{$streamPost['type']}/{$streamPost['id']}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime($streamPost['date']))->format('c'),
            'changefreq' => 'never',
            'priority' => .5,
        ],
    ];
}

$entryArray += [
    '/about/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'monthly',
        'priority' => .7,
    ]
];

$buildSitemap($entryArray, 'http://lifestream.jacobemerick.com', 'lifestream');


/*********************************************
 * portfolio.jacobemerick.com
 *********************************************/
$portfolioRepository = new PortfolioPieceRepository($container['db_connection_locator']);
$portfolioPieces = $portfolioRepository->getPieces();

$entryArray = [
    '/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'weekly',
        'priority' => 1,
    ],
    '/print/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'never',
        'priority' => .1,
    ],
    '/web/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'never',
        'priority' => .1,
    ],
    '/contact/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'never',
        'priority' => .4,
    ],
    '/resume/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'yearly',
        'priority' => .9,
    ],
];

foreach ($portfolioPieces as $portfolioPiece) {
    $portfolioCategory = ($portfolioPiece['category'] == 1) ? 'web' : 'print';
    $entryKey = "/{$portfolioCategory}/{$portfolioPiece['title_url']}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
            'changefreq' => 'never',
            'priority' => .7,
        ],
    ];
}

$buildSitemap($entryArray, 'http://portfolio.jacobemerick.com', 'portfolio');


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


/*********************************************
 * www.waterfallofthekeweenaw.com
 *********************************************/
$reduceToMostRecentJournalLog = function ($recentLog, $log) {
    if (is_null($recentLog)) {
        return $log;
    }
    $logDate = new DateTime($log['publish_date']);
    $recentLogDate = new DateTime($recentLog['publish_date']);
    return ($logDate > $recentLogDate) ? log: $recentLog;
};

$waterfallRepository = new WaterfallRepository($container['db_connection_locator']);
$waterfallList = $waterfallRepository->getWaterfalls();

$entryArray = [
    '/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'daily',
        'priority' => 1,
    ],
    '/falls/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'weekly',
        'priority' => .3,
    ],
];

for ($i = 2; (($i - 1) * 24) < count($waterfallList); $i++) {
    $entryKey = "/falls/{$i}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => .1,
        ]
    ];
}

$waterfallCountyRepository = new WaterfallCountyRepository($container['db_connection_locator']);
$waterfallCountyList = $waterfallCountyRepository->getCountyList();

foreach ($waterfallCountyList as $waterfallCounty) {
    $entryKey = "/{$waterfallCounty['alias']}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
            'changefreq' => 'monthly',
            'priority' => .6
        ]
    ];

    for ($i = 2; (($i - 1) * 12) < $waterfallCounty['count']; $i++) {
        $entryKey = "/{$waterfallCounty['alias']}/{$i}/";
        $entryArray += [
            $entryKey => [
                'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => .1
            ]
        ];
    }
}

$waterfallWatercourseRepository = new WaterfallWatercourseRepository($container['db_connection_locator']);
$waterfallWatercourseList = $waterfallWatercourseRepository->getWatercourseList();

foreach ($waterfallWatercourseList as $waterfallWatercourse) {
    $entryKey = "/{$waterfallWatercourse['alias']}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
            'changefreq' => 'monthly',
            'priority' => .6
        ]
    ];

    for ($i = 2; (($i - 1) * 12) < $waterfallWatercourse['count']; $i++) {
        $entryKey = "/{$waterfallWatercourse['alias']}/{$i}/";
        $entryArray += [
            $entryKey => [
                'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => .1
            ]
        ];
    }
}

foreach ($waterfallList as $waterfall) {
    $entryKey = "/{$waterfall['watercourse_alias']}/{$waterfall['alias']}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => .8,
        ],
    ];
}

$entryArray += [
    '/map/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'monthly',
        'priority' => .6,
    ]
];

$waterfallLogRepository = new WaterfallLogRepository($container['db_connection_locator']);
$activeWaterfallLogs = $waterfallLogRepository->getActiveLogs();

$mostRecentWaterfallLog = array_reduce($activeWaterfallLogs, $reduceToMostRecentJournalLog);

$entryArray += [
    '/journal/' => [
        'lastmod' => (new DateTime($mostRecentWaterfallLog['publish_date']))->format('c'),
        'changefreq' => 'weekly',
        'priority' => .3,
    ],
];

for ($i = 2; (($i - 1) * 10) < count($activeWaterfallLogs); $i++) {
    $entryKey = "/journal/{$i}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime($mostRecentWaterfallLog['publish_date']))->format('c'),
            'changefreq' => 'weekly',
            'priority' => .1,
        ]
    ];
}

$waterfallCompanionRepository = new WaterfallCompanionRepository($container['db_connection_locator']);
$waterfallCompanionList = $waterfallCompanionRepository->getCompanionList();

foreach ($waterfallCompanionList as $waterfallCompanion) {
    $entryKey = "/companion/{$waterfallCompanion['alias']}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'), // todo based on log
            'changefreq' => 'monthly',
            'priority' => .2
        ]
    ];

    for ($i = 2; (($i - 1) * 10) < $waterfallCompanion['count']; $i++) {
        $entryKey = "/companion/{$waterfallCompanion['alias']}/{$i}/";
        $entryArray += [
            $entryKey => [
                'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => .1
            ]
        ];
    }
}

$waterfallPeriodRepository = new WaterfallPeriodRepository($container['db_connection_locator']);
$waterfallPeriodList = $waterfallPeriodRepository->getPeriodList();

foreach ($waterfallPeriodList as $waterfallPeriod) {
    $entryKey = "/period/{$waterfallPeriod['alias']}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'), // todo based on log
            'changefreq' => 'monthly',
            'priority' => .2
        ]
    ];

    for ($i = 2; (($i - 1) * 10) < $waterfallPeriod['count']; $i++) {
        $entryKey = "/period/{$waterfallPeriod['alias']}/{$i}/";
        $entryArray += [
            $entryKey => [
                'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => .1
            ]
        ];
    }
}

foreach ($activeWaterfallLogs as $waterfallLog) {
    $entryKey = "/journal/{$waterfallLog['alias']}/";
    $entryArray += [
        $entryKey => [
            'lastmod' => (new DateTime($waterfallLog['publish_date']))->format('c'),
            'changefreq' => 'weekly',
            'priority' => .4,
        ],
    ];
}

$entryArray += [
    '/about/' => [
        'lastmod' => (new DateTime('December 20, 2015'))->format('Y-m-d'),
        'changefreq' => 'monthly',
        'priority' => .6,
    ]
];

$buildSitemap($entryArray, 'http://www.waterfallsofthekeweenaw.com', 'waterfalls');
