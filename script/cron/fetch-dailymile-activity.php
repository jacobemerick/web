<?php

require_once __DIR__ . '/../index.php';

use DailymilePHP\Client;
use Jacobemerick\Web\Domain\Stream\DailyMile\MysqlDailyMileRepository as DailyMileRepository;

$client = new Client();

$dailyMileRepository = new DailyMileRepository($container['db_connection_locator']);
$mostRecentEntry = $dailyMileRepository->getEntries(1);
$mostRecentEntry = current($mostRecentEntry);
$mostRecentEntryDateTime = $mostRecentEntry['datetime'];
$mostRecentEntryDateTime = new DateTime($mostRecentEntryDateTime);

$parameters = [
    'username' => 'JacobE4',
    'since' => $mostRecentEntryDateTime->getTimestamp()
];
$entries = $client->getEntries($parameters);

foreach ($entries as $entry) {
    $uniqueEntryCheck = $dailyMileRepository->getEntryByEntryId($entry['id']);
    if ($uniqueEntryCheck !== false) {
        continue;
    }

    $dailyMileRepository->insertEntry(
        $entry['id'],
        $entry['workout']['activity_type'],
        (new DateTime($entry['at']))->setTimezone($container['default_timezone']),
        $entry
    );
}
