<?php

require_once __DIR__ . '/../index.php';

use Jacobemerick\Web\Domain\Stream\Blog\MysqlBlogRepository as BlogRepository;
use Jacobemerick\Web\Domain\Stream\BlogComment\MysqlBlogCommentRepository as BlogCommentRepository;

$blogRepository = new BlogRepository($container['db_connection_locator']);
$mostRecentBlog = $blogRepository->getBlogs(1);
$mostRecentBlog = current($mostRecentBlog);
$mostRecentBlogDateTime = $mostRecentBlog['datetime'];
$mostRecentBlogDateTime = new DateTime($mostRecentBlogDateTime);

$blogFeed = Feed::loadRss('http://blog.jacobemerick.com/rss.xml');
foreach ($blogFeed->item as $item) {
    $datetime = new DateTime($item->pubDate);
    if ($datetime <= $mostRecentBlogDateTime) {
        break;
    }

    $uniqueBlogCheck = $blogRepository->getBlogByPermalink((string) $item->guid);
    if ($uniqueBlogCheck !== false) {
        continue;
    }

    $datetime->setTimezone($container['default_timezone']);
    $metadata = json_decode(json_encode($item), true);

    $blogRepository->insertBlog(
        (string) $item->guid,
        $datetime,
        $metadata
    );
}

$blogCommentRepository = new BlogCommentRepository($container['db_connection_locator']);
$mostRecentBlogComment = $blogCommentRepository->getBlogComments(1);
$mostRecentBlogComment = current($mostRecentBlogComment);
$mostRecentBlogCommentDateTime = $mostRecentBlogComment['datetime'];
$mostRecentBlogCommentDateTime = new DateTime($mostRecentBlogCommentDateTime);

$commentFeed = Feed::loadRss('http://blog.jacobemerick.com/rss-comments.xml');
foreach ($commentFeed->item as $item) {
    $datetime = new DateTime($item->pubDate);
    if ($datetime <= $mostRecentBlogCommentDateTime) {
        break;
    }

    $uniqueBlogCommentCheck = $blogCommentRepository->getBlogCommentByPermalink((string) $item->guid);
    if ($uniqueBlogCommentCheck !== false) {
        continue;
    }

    $datetime->setTimezone($container['default_timezone']);
    $metadata = json_decode(json_encode($item), true);

    $blogCommentRepository->insertBlogComment(
        (string) $item->guid,
        $datetime,
        $metadata
    );
}
