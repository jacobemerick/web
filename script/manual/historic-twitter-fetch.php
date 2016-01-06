<?php

require_once __DIR__ . '/../index.php';

$options = getopt('f:');
if (empty($options['f'])) {
    exit('Must pass in a file with the f parameter.');
}

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

$idList = [];

$handle = fopen(__DIR__ . '/' . $options['f'], 'r');
while ($row = fgets($handle)) {
    array_push($idList, trim($row));
    if (count($idList) == 100) {
        $tweetLookup = $client->get('statuses/lookup', [
            'id' => implode(',', $idList),
            'trim_user' => true,
        ]);

        foreach ($tweetLookup as $tweet) {
            $uniqueTweetCheck = $twitterRepository->getTwitterByTweetId($tweet['id_str']);
            if ($uniqueTweetCheck !== false) {
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
        $idList = [];
    }
}
fclose($handle);
