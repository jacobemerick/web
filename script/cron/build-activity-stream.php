<?php

require_once __DIR__ . '/../index.php';

use Jacobemerick\Web\Domain\Stream\Activity\MysqlActivityRepository as ActivityRepository;
$activityRepository = new ActivityRepository($container['db_connection_locator']);

// blogs
use Jacobemerick\Web\Domain\Stream\Blog\MysqlBlogRepository as BlogRepository;
$blogRepository = new BlogRepository($container['db_connection_locator']);

$lastBlogActivity = $activityRepository->getActivityLastUpdateByType('blog');
if ($lastBlogActivity === false) {
    $lastBlogActivityDateTime = new DateTime('2008-05-03');
} else {
    $lastBlogActivityDateTime = new DateTime($lastBlogActivity['updated_at']);
    $lastBlogActivityDateTime->modify('-5 days');
}
$newBlogActivity = $blogRepository->getBlogsUpdatedSince($lastBlogActivityDateTime);
foreach ($newBlogActivity as $blog) {
    $uniqueBlogCheck = $activityRepository->getActivityByTypeId('blog', $blog['id']);
    if ($uniqueBlogCheck !== false) {
        continue;
    }

    $blogData = json_decode($blog['metadata'], true);
    $message = sprintf(
        'Blogged about %s: <a href="%s" title="Jacob Emerick\'s Blog | %s">%s</a>.',
        str_replace('-', ' ', $blogData['category']),
        $blogData['link'],
        $blogData['title'],
        $blogData['title']
    );
    $messageLong = sprintf(
        "<h4><a href=\"%s\" title=\"Jacob Emerick's Blog | %s\">%s</a></h4>\n" .
        "<p>%s [<a href=\"%s\">read more</a></a>]</p>",
        $blogData['link'],
        $blogData['title'],
        $blogData['title'],
        htmlentities($blogData['description']),
        $blogData['link']
    );

    $activityRepository->insertActivity(
        $message,
        $messageLong,
        (new DateTime($blog['datetime'])),
        [],
        'blog',
        $blog['id']
    );
}

use Jacobemerick\Web\Domain\Stream\BlogComment\MysqlBlogCommentRepository as BlogCommentRepository;
$blogCommentRepository = new BlogCommentRepository($container['db_connection_locator']);
$blogCommentActivity = $blogCommentRepository->getBlogComments();
$blogCommentHolder = [];
foreach ($blogCommentActivity as $blogComment) {
    $blogPermalink = $blogComment['permalink'];
    $blogPermalink = explode('#', $blogPermalink);
    $blogPermalink = current($blogPermalink);

    $blog = $blogRepository->getBlogByPermalink($blogPermalink);
    if (!array_key_exists($blog['id'], $blogCommentHolder)) {
        $blogCommentHolder[$blog['id']] = 1;
    } else {
        $blogCommentHolder[$blog['id']]++;
    }
}

foreach ($blogCommentHolder as $blogId => $commentCount) {
    $blogActivity = $activityRepository->getActivityByTypeId('blog', $blogId);
    $blogActivityMetadata = json_decode($blogActivity['metadata'], true);
    if (
        !isset($blogActivityMetadata['comments']) ||
        $blogActivityMetadata['comments'] != $commentCount
    ) {
        $activityRepository->updateActivityMetadata(
            $blogActivity['id'],
            ['comments' => $commentCount]
        );
    }
}

// distance
use Jacobemerick\Web\Domain\Stream\DailyMile\MysqlDailyMileRepository as DailyMileRepository;
$dailyMileRepository = new DailyMileRepository($container['db_connection_locator']);

$lastDailyMileActivity = $activityRepository->getActivityLastUpdateByType('distance');
if ($lastDailyMileActivity === false) {
    $lastDailyMileActivityDateTime = new DateTime('2008-05-03');
} else {
    $lastDailyMileActivityDateTime = new DateTime($lastDailyMileActivity['updated_at']);
    $lastDailyMileActivityDateTime->modify('-5 days');
}
$newDailyMileActivity = $dailyMileRepository->getDailyMilesUpdatedSince($lastDailyMileActivityDateTime);
foreach ($newDailyMileActivity as $dailyMile) {
    $uniqueDailyMileCheck = $activityRepository->getActivityByTypeId('distance', $dailyMile['id']);
    if ($uniqueDailyMileCheck !== false) {
        continue;
    }

    $dailyMileData = json_decode($dailyMile['metadata'], true);
    if ($dailyMile['type'] == 'Hiking') {
        $message = sprintf(
            '%s %.2f %s and felt %s.',
            'Hiked',
            $dailyMileData['workout']['distance']['value'],
            $dailyMileData['workout']['distance']['units'],
            $dailyMileData['workout']['felt']
        );
        $messageLong = "<p>{$message}</p>";
        if (isset($dailyMileData['workout']['title'])) {
            $messageLong .= "\n<p>I was hiking up around the {$dailyMileData['workout']['title']} area.</p>";
        }
    } else if ($dailyMile['type'] == 'Running') {
        $message = sprintf(
            '%s %.2f %s and felt %s.',
            'Ran',
            $dailyMileData['workout']['distance']['value'],
            $dailyMileData['workout']['distance']['units'],
            $dailyMileData['workout']['felt']
        );
        $messageLong = "<p>{$message}</p>";
        if (isset($dailyMileData['message'])) {
            $messageLong .= "\n<p>Afterwards, I was all like '{$dailyMileData['message']}'.</p>";
        }
    } else if ($dailyMile['type'] == 'Walking') {
        $message = sprintf(
            '%s %.2f %s and felt %s.',
            'Walked',
            $dailyMileData['workout']['distance']['value'],
            $dailyMileData['workout']['distance']['units'],
            $dailyMileData['workout']['felt']
        );
        $messageLong = "<p>{$message}</p>";
        if (isset($dailyMileData['message'])) {
            $messageLong .= "\n<p>{$dailyMileData['message']}</p>";
        }
    } else {
        continue;
    }

    $activityRepository->insertActivity(
        $message,
        $messageLong,
        (new DateTime($dailyMile['datetime'])),
        [],
        'distance',
        $dailyMile['id']
    );
}

// books
use Jacobemerick\Web\Domain\Stream\Goodread\MysqlGoodreadRepository as GoodreadRepository;
$goodreadRepository = new GoodreadRepository($container['db_connection_locator']);

$lastGoodreadActivity = $activityRepository->getActivityLastUpdateByType('book');
if ($lastGoodreadActivity === false) {
    $lastGoodreadActivityDateTime = new DateTime('2010-08-28');
} else {
    $lastGoodreadActivityDateTime = new DateTime($lastGoodreadActivity['updated_at']);
    $lastGoodreadActivityDateTime->modify('-5 days');
}
$newGoodreadActivity = $goodreadRepository->getGoodreadsUpdatedSince($lastGoodreadActivityDateTime);
foreach ($newGoodreadActivity as $goodread) {
    $uniqueGoodreadCheck = $activityRepository->getActivityByTypeId('book', $goodread['id']);
    if ($uniqueGoodreadCheck !== false) {
        continue;
    }

    $goodreadData = json_decode($goodread['metadata'], true);

    if (empty($goodreadData['user_read_at'])) {
        continue;
    }

    $message = sprintf(
        'Just finished reading %s by %s.',
        $goodreadData['title'],
        $goodreadData['author_name']
    );
    if (isset($goodreadData['book_large_image_url'])) {
        $messageLong = sprintf(
            "<img alt=\"Goodreads | %s\" src=\"%s\" />\n",
            $goodreadData['title'],
            $goodreadData['book_large_image_url']
        );
    }
    $messageLong .= "<p>{$message}</p>";

    $activityRepository->insertActivity(
        $message,
        $messageLong,
        (new DateTime($goodread['datetime'])),
        [],
        'book',
        $goodread['id']
    );
}


