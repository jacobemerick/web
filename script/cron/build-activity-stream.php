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
    $blogActivityMetadata = json_decode($blogActivity['metadata']);
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
