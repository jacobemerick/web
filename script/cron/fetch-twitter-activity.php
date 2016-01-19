<?php

require_once __DIR__ . '/../index.php';

use Abraham\TwitterOAuth\TwitterOAuth;
use Jacobemerick\Web\Domain\Stream\Twitter\MysqlTwitterRepository as TwitterRepository;

$client = new TwitterOAuth(
    $config->twitter->consumer_key,
    $config->twitter->consumer_secret,
    $config->twitter->access_token,
    $config->twitter->access_token_secret
);
$client->setDecodeJsonAsArray(true);

$twitterRepository = new TwitterRepository($container['db_connection_locator']);

$recentTweets = $client->get('statuses/user_timeline', [
    'screen_name' => 'jpemeric',
    'count' => 50,
    'trim_user' => true,
]);

if (isset($recentTweets['errors'])) {
    throw new Exception("Error encountered with twitter api {$recentTweets['errors'][0]['message']}");
}

foreach ($recentTweets as $tweet) {
    $uniqueTweetCheck = $twitterRepository->getTwitterByTweetId($tweet['id_str']);
    if ($uniqueTweetCheck !== false) {
        $currentTweetHash = md5($uniqueTweetCheck['metadata']);
        $newTweetHash = md5(json_encode($tweet));
        if ($uniqueTweetCheck['metadata'] != json_encode($tweet)) {
            $twitterRepository->updateTweetMetadata($tweet['id_str'], $tweet);
        }
        continue;
    }

    $twitterRepository->insertTweet(
        $tweet['id_str'],
        (new DateTime($tweet['created_at']))->setTimezone($container['default_timezone']),
        $tweet
    );
}

