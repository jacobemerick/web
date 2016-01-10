<?php

require_once __DIR__ . '/../index.php';

use Jacobemerick\Web\Domain\Stream\Activity\MysqlActivityRepository as ActivityRepository;
$activityRepository = new ActivityRepository($container['db_connection_locator']);
$pdo = $container['db_connection_locator']->getWrite();

$query = "
    SELECT *
    FROM `jpemeric_stream`.`hulu`
    ORDER BY `date` DESC";
$huluActivities = $pdo->fetchAll($query);
foreach ($huluActivities as $huluActivity) {
    $activityRepository->insertActivity(
        "Watched {$huluActivity['title']} on Hulu.",
        "<p>Watched {$huluActivity['title']} on Hulu.</p>",
        new DateTime($huluActivity['date'], $container['default_timezone']),
        [],
        'hulu',
        $huluActivity['id']
    );
}
