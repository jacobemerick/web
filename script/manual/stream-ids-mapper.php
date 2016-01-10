<?php

require_once __DIR__ . '/../index.php';

$pdo = $container['db_connection_locator']->getWrite();

$idMap = [];

$query = "
    SELECT `post`.`id`, `blog`.`url`
    FROM `jpemeric_stream`.`post`
    INNER JOIN `jpemeric_stream`.`blog` ON `blog`.`id` = `post`.`type_id`
    WHERE `type` = 'blog'";
$statement = $pdo->prepare($query);
$statement->execute();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $query = "
        SELECT `activity`.`id`
        FROM `jpemeric_stream`.`activity`
        INNER JOIN `jpemeric_stream`.`blog2` ON `blog2`.`id` = `activity`.`type_id` AND
                                                `blog2`.`permalink` LIKE '{$row['url']}%'
        WHERE `type` = 'blog'";
    $updateRecords = $pdo->fetchAll($query);
    if (count($updateRecords) !== 1) {
        if ($row['url'] == 'http://blog.jacobemerick.com/hiking/slightly-shuffled/') {
            continue;
        }
        var_dump($updateRecords);
        var_dump($row);
        exit('problem with blog uniqueness');
    }
    $idMap[current($updateRecords)['id']] = $row['id'];
}

$query = "
    SELECT `post`.`id`, `book`.`link`
    FROM `jpemeric_stream`.`post`
    INNER JOIN `jpemeric_stream`.`book` ON `book`.`id` = `post`.`type_id`
    WHERE `type` = 'book'";
$statement = $pdo->prepare($query);
$statement->execute();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $query = "
        SELECT `activity`.`id`
        FROM `jpemeric_stream`.`activity`
        INNER JOIN `jpemeric_stream`.`goodread` ON `goodread`.`id` = `activity`.`type_id` AND
                                                   `goodread`.`permalink` = :url
        WHERE `type` = 'book'";
    $updateRecords = $pdo->fetchAll($query, ['url' => $row['link']]);
    if (count($updateRecords) !== 1) {
        exit('problem with book uniqueness');
    }
    $idMap[current($updateRecords)['id']] = $row['id'];
}

$query = "
    SELECT `post`.`id`, `distance`.`url`
    FROM `jpemeric_stream`.`post`
    INNER JOIN `jpemeric_stream`.`distance` ON `distance`.`id` = `post`.`type_id`
    WHERE `post`.`type` = 'distance'";
$statement = $pdo->prepare($query);
$statement->execute();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $query = "
        SELECT `activity`.`id`
        FROM `jpemeric_stream`.`activity`
        INNER JOIN `jpemeric_stream`.`dailymile` ON `dailymile`.`id` = `activity`.`type_id` AND
                                                    `dailymile`.`entry_id` = :entry_id
        WHERE `activity`.`type` = 'distance'";
    $entryId = $row['url'];
    $entryId = explode('/', $entryId);
    $entryId = end($entryId);
    $updateRecords = $pdo->fetchAll($query, ['entry_id' => $entryId]);
    if (count($updateRecords) !== 1) {
        exit('problem with distance uniqueness');
    }
    $idMap[current($updateRecords)['id']] = $row['id'];
}

$query = "
    SELECT `post`.`id`, `twitter`.`twitter_id`
    FROM `jpemeric_stream`.`post`
    INNER JOIN `jpemeric_stream`.`twitter` ON `twitter`.`id` = `post`.`type_id`
    WHERE `type` = 'twitter'";
$statement = $pdo->prepare($query);
$statement->execute();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $query = "
        SELECT `activity`.`id`
        FROM `jpemeric_stream`.`activity`
        INNER JOIN `jpemeric_stream`.`twitter2` ON `twitter2`.`id` = `activity`.`type_id` AND
                                                   `twitter2`.`tweet_id` = :tweet_id
        WHERE `type` = 'twitter'";
    $updateRecords = $pdo->fetchAll($query, ['tweet_id' => $row['twitter_id']]);
    if (count($updateRecords) !== 1) {
        if (count($updateRecords) === 0) {
            echo 'Could not find match for id: ', $row['twitter_id'], PHP_EOL;
            continue;
        }
        exit('problem with twitter uniqueness');
    }
    $idMap[current($updateRecords)['id']] = $row['id'];
}

$query = "
    SELECT `post`.`id`, `post`.`type_id`
    FROM `jpemeric_stream`.`post`
    WHERE `type` = 'youtube'";
$statement = $pdo->prepare($query);
$statement->execute();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $query = "
        SELECT `activity`.`id`
        FROM `jpemeric_stream`.`activity`
        WHERE `activity`.`type` = 'youtube' AND `activity`.`type_id` = :type_id";
    $updateRecords = $pdo->fetchAll($query, ['type_id' => $row['type_id']]);
    if (count($updateRecords) != 1) {
        if (count($updateRecords) === 0) {
            echo "could not find match for youtube {$row['type_id']}", PHP_EOL;
            continue;
        }
        exit('problem with youtube uniqueness');
    }
    $idMap[current($updateRecords)['id']] = $row['id'];
}

foreach ($idMap as $currentId => $newId) {
    $query = "
        UPDATE `activity` SET `id` = :new_id WHERE `id` = :current_id";
    $update = $pdo->perform($query, ['new_id' => $newId, 'current_id' => $currentId]);
    if ($update === false) {
        exit('problem with update');
    }
}
