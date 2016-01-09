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

// github
use Jacobemerick\Web\Domain\Stream\Github\MysqlGithubRepository as GithubRepository;
$githubRepository = new GithubRepository($container['db_connection_locator']);

$lastGithubActivity = $activityRepository->getActivityLastUpdateByType('git');
if ($lastGithubActivity === false) {
    $lastGithubActivityDateTime = new DateTime('2015-10-01');
} else {
    $lastGithubActivityDateTime = new DateTime($lastGithubActivity['updated_at']);
    $lastGithubActivityDateTime->modify('-5 days');
}
$newGithubActivity = $githubRepository->getGithubsUpdatedSince($lastGithubActivityDateTime);
foreach ($newGithubActivity as $github) {
    $uniqueGithubCheck = $activityRepository->getActivityByTypeId('git', $github['id']);
    if ($uniqueGithubCheck !== false) {
        continue;
    }

    $githubData = json_decode($github['metadata'], true);

    if ($github['type'] == 'CreateEvent') {
        if (
            $githubData['payload']['ref_type'] == 'branch' ||
            $githubData['payload']['ref_type'] == 'tag'
        ) {
            $message = sprintf(
                'Created %s %s at %s.',
                $githubData['payload']['ref_type'],
                $githubData['payload']['ref'],
                $githubData['repo']['name']
            );
            $messageLong = sprintf(
                '<p>Created %s %s at <a href="%s" target="_blank" title="Github | %s">%s</a>.</p>',
                $githubData['payload']['ref_type'],
                $githubData['payload']['ref'],
                "https://github.com/{$githubData['repo']['name']}",
                $githubData['repo']['name'],
                $githubData['repo']['name']
            );
        } else if ($githubData['payload']['ref_type'] == 'repository') {
            $message = sprintf(
                'Created %s %s.',
                $githubData['payload']['ref_type'],
                $githubData['repo']['name']
            );
            $messageLong = sprintf(
                '<p>Created %s <a href="%s" target="_blank" title="Github | %s">%s</a>.</p>',
                $githubData['payload']['ref_type'],
                "https://github.com/{$githubData['repo']['name']}",
                $githubData['repo']['name'],
                $githubData['repo']['name']
            );
        } else {
            continue;
        }
    } else if ($github['type'] == 'ForkEvent') {
        $message = sprintf(
            'Forked %s to %s',
            $githubData['repo']['name'],
            $githubData['payload']['forkee']['full_name']
        );
        $messageLong = sprintf(
            '<p>Forked <a href="%s" target="_blank" title="Github | %s">%s</a> to <a href="%s" target="_blank" title="Github | %s">%s</a>.',
            "https://github.com/{$githubData['repo']['name']}",
            $githubData['repo']['name'],
            $githubData['repo']['name'],
            $githubData['payload']['forkee']['html_url'],
            $githubData['payload']['forkee']['full_name'],
            $githubData['payload']['forkee']['full_name']
        );
    } else if ($github['type'] == 'PullRequestEvent') {
        $message = sprintf(
            '%s a pull request at %s',
            ucwords($githubData['payload']['action']),
            $githubData['repo']['name']
        );
        $messageLong = sprintf(
            '<p>%s pull request <a href="%s" target="_blank" title="Github | %s PR %d">%d</a> at <a href="%s" target="_blank" title="Github | %s">%s</a>.</p>',
            ucwords($githubData['payload']['action']),
            $githubData['payload']['pull_request']['html_url'],
            $githubData['repo']['name'],
            $githubData['payload']['number'],
            $githubData['payload']['number'],
            "https://github.com/{$githubData['repo']['name']}",
            $githubData['repo']['name'],
            $githubData['repo']['name']
        );
    } else if ($github['type'] == 'PushEvent') {
        $message = sprintf(
            'Pushed some code at %s.',
            $githubData['repo']['name']
        );
        $messageLong = sprintf(
            "<p>Pushed some code at <a href=\"%s\" target=\"_blank\" title=\"Github | %s\">%s</a>.</p>\n",
            $githubData['payload']['ref'],
            "https://github.com/{$githubData['repo']['name']}",
            $githubData['repo']['name'],
            $githubData['repo']['name']
        );
        $messageLong .= "<ul>\n";
        foreach ($githubData['payload']['commits'] as $commit) {
            $messageShort = $commit['message'];
            $messageShort = strtok($messageShort, "\n");
            if (strlen($messageShort) > 72) {
                $messageShort = wordwrap($messageShort, 65);
                $messageShort = strtok($messageShort, "\n");
                $messageShort .= '...';
            }
            $messageLong .= sprintf(
                "<li><a href=\"%s\" target=\"_blank\" title=\"Github | %s\">%s</a> %s.</p>\n",
                "https://github.com/{$githubData['repo']['name']}/commit/{$commit['sha']}",
                substr($commit['sha'], 0, 7),
                substr($commit['sha'], 0, 7),
                $messageShort
            );
        }
        $messageLong .= "</ul>";
    }

    $activityRepository->insertActivity(
        $message,
        $messageLong,
        (new DateTime($github['datetime'])),
        [],
        'git',
        $github['id']
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
