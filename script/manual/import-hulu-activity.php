<?php

require_once __DIR__ . '/../index.php';

use Jacobemerick\Web\Domain\Stream\Activity\MysqlActivityRepository as ActivityRepository;
$activityRepository = new ActivityRepository($container['db_connection_locator']);
$pdo = $container['db_connection_locator']->getWrite();

$query = "
    SELECT `post`.`id`, `hulu`.`id` AS `type_id`, `hulu`.`title`, `hulu`.`date`
    FROM `jpemeric_stream`.`hulu`
    INNER JOIN `jpemeric_stream`.`post` ON `post`.`type_id` = `hulu`.`id` AND
                                           `post`.`type` = 'hulu'
    ORDER BY `hulu`.`date` DESC";
$huluActivities = $pdo->fetchAll($query);
foreach ($huluActivities as $huluActivity) {
    $query = "
        INSERT INTO `jpemeric_stream`.`activity`
            (`id`, `message`, `message_long`, `datetime`, `metadata`, `type`, `type_id`)
        VALUES
            (:id, :message, :message_long, :datetime, :metadata, :type, :type_id)";

    $bindings = [
        'id' => $huluActivity['id'],
        'message' => "Watched {$huluActivity['title']} on Hulu.",
        'message_long' => "<p>Watched {$huluActivity['title']} on Hulu.</p>",
        'datetime' => (new DateTime($huluActivity['date'], $container['default_timezone']))->format('Y-m-d H:i:s'),
        'metadata' => json_encode([]),
        'type' => 'hulu',
        'type_id' => $huluActivity['type_id'],
    ];

    $pdo->perform($query, $bindings);
}
