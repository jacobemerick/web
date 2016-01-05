<?php

require_once __DIR__ . '/../index.php';

use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;

use Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository as BlogPostRepository;
use Jacobemerick\Web\Domain\Comment\Comment\MysqlCommentRepository as CommentRepository;

/**
 * Helper function to output each feed
 *
 * @param Feed   $feed
 * @param string $folder
 * @return boolean
 */
$buildFeed = function (Feed $feed, $folder, $name = 'rss') {
    $tempFeed = __DIR__ . "/../../public/{$folder}/{$name}-new.xml";
    $finalFeed = __DIR__ . "/../../public/{$folder}/{$name}.xml";

    $feedHandle = fopen($tempFeed, 'w');
    fwrite($feedHandle, $feed->render());
    fclose($feedHandle);

    rename($tempFeed, $finalFeed);
};


/*********************************************
 * blog.jacobemerick.com
 *********************************************/
$blogPostFeed = new Feed();

$blogPostChannel = new Channel();
$blogPostChannel->title('Jacob Emerick | Blog Feed');
$blogPostChannel->description('Most recent blog entries of Jacob Emerick, a software engineer that hikes.');
$blogPostChannel->url('http://blog.jacobemerick.com'); // todo depends on env
$blogPostChannel->appendTo($blogPostFeed);

$blogPostRepository = new BlogPostRepository($container['db_connection_locator']);
$activeBlogPosts = $blogPostRepository->getActivePosts();

foreach ($activeBlogPosts as $blogPost) {
    $blogPostItem = new Item();

    $blogPostItem->title($blogPost['title']);

    $url = "http://blog.jacobemerick.com/{$blogPost['category']}/{$blogPost['path']}/";
    $blogPostItem->url($url);
    $blogPostItem->guid($url, true);

    $description = $blogPost['body'];
    $description = strip_tags($description);
    $description = strtok($description, "\n");
    if (strlen($description) > 250) {
        $description = wordwrap($description, 250);
        $description = strtok($description, "\n");
        if (substr($description, -1) != '.') {
            $description .= '&hellip;';
        }
    }
    $description = html_entity_decode($description);
    $blogPostItem->description($description);

    $categoryUrl = "http://blog.jacobemerick.com/{$blogPost['category']}/";
    $blogPostItem->category($blogPost['category'], $categoryUrl);

    $pubDate = new DateTime($blogPost['date']);
    $blogPostItem->pubDate($pubDate->getTimestamp());

    $blogPostItem->appendTo($blogPostChannel);
}

$buildFeed($blogPostFeed, 'blog');


$blogCommentFeed = new Feed();

$blogCommentChannel = new Channel();
$blogCommentChannel->title('Jacob Emerick | Blog Comment Feed');
$blogCommentChannel->description('Most recent comments on blog posts of Jacob Emerick');
$blogCommentChannel->url('http://blog.jacobemerick.com'); // todo depends on env
$blogCommentChannel->appendTo($blogCommentFeed);

$commentRepository = new CommentRepository($container['db_connection_locator']);
$activeBlogComments = $commentRepository->getActiveCommentsBySite('blog');

foreach ($activeBlogComments as $blogComment) {
    $blogCommentItem = new Item();

    $blogCommentItem->title("Comment on '{$blogComment['title']}' from {$blogComment['name']}");
    $blogCommentItem->author($blogComment['name']);

    $url = "http://blog.jacobemerick.com/{$blogComment['category']}/{$blogComment['path']}/";
    $url .= "#comment-{$blogComment['id']}";
    $blogCommentItem->url($url);
    $blogCommentItem->guid($url, true);

    $description = $blogComment['body'];
    $description = strip_tags($description);
    $description = strtok($description, "\n");
    if (strlen($description) > 250) {
        $description = wordwrap($description, 250);
        $description = strtok($description, "\n");
        if (substr($description, -1) != '.') {
            $description .= '&hellip;';
        }
    }
    $description = html_entity_decode($description);
    $description = trim($description);
    $blogCommentItem->description($description);

    $pubDate = new DateTime($blogComment['date']);
    $blogCommentItem->pubDate($pubDate->getTimestamp());

    $blogCommentItem->appendTo($blogCommentChannel);
}

$buildFeed($blogCommentFeed, 'blog', 'rss-comments');
