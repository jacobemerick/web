<?php

require_once __DIR__ . '/../index.php';

use Madcoda\Youtube;
use Jacobemerick\Web\Domain\Stream\YouTube\MysqlYouTubeRepository as YouTubeRepository;

$client = new Youtube(['key' => $config->youtube->key]);

$youTubeRepository = new YouTubeRepository($container['db_connection_locator']);
$mostRecentVideo = $youTubeRepository->getYouTubes(1);
$mostRecentVideo = current($mostRecentVideo);
$mostRecentVideoDateTime = $mostRecentVideo['datetime'];
$mostRecentVideoDateTime = new DateTime($mostRecentVideoDateTime);

$playlist = $client->getPlaylistItemsByPlaylistId($config->youtube->favorites_playlist, 10);

foreach ($playlist as $playlistItem) {
    $datetime = new DateTime($playlistItem->snippet->publishedAt);
    if ($datetime <= $mostRecentVideoDateTime) {
        break;
    }

    $videoId = $playlistItem->contentDetails->videoId;
    $uniqueVideoCheck = $youTubeRepository->getYouTubeByVideoId($videoId);
    if ($uniqueVideoCheck !== false) {
        continue;
    }

    $datetime->setTimezone($container['default_timezone']);
    $metadata = json_decode(json_encode($playlistItem), true);

    $youTubeRepository->insertVideo(
        $videoId,
        $datetime,
        $metadata
    );
}
