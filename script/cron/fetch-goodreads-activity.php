<?php

require_once __DIR__ . '/../index.php';

use GuzzleHttp\Client;
use Jacobemerick\Web\Domain\Stream\Goodread\MysqlGoodreadRepository as GoodreadRepository;

$client = new Client([
    'base_uri' => 'http://www.goodreads.com',
]);

$goodreadRepository = new GoodreadRepository($container['db_connection_locator']);
$mostRecentReview = $goodreadRepository->getReviews(1);
$mostRecentReview = current($mostRecentReview);
$mostRecentReviewDateTime = $mostRecentReview['datetime'];
$mostRecentReviewDateTime = new DateTime($mostRecentReviewDateTime);

$response = $client->get("/review/list_rss/{$config->goodread->shelf_id}");
$reviews = (string) $response->getBody();
$reviews = simplexml_load_string($reviews, 'SimpleXMLElement', LIBXML_NOCDATA);

foreach ($reviews->channel->item as $review) {
    $datetime = new DateTime((string) $review->pubDate);
    if ($datetime <= $mostRecentReviewDateTime) {
        break;
    }

    $uniqueReviewCheck = $goodreadRepository->getReviewByPermalink((string) $review->guid);
    if ($uniqueReviewCheck !== false) {
        continue;
    }

    $datetime->setTimezone($container['default_timezone']);
    $metadata = json_decode(json_encode($review), true);

    $goodreadRepository->insertReview(
        (string) $review->guid,
        (string) $review->book_id,
        $datetime,
        $metadata
    );
}
