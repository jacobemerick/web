<?php

namespace Jacobemerick\Web\Domain\Stream\Twitter;

use Aura\Sql\ConnectionLocator;
use DateTime;

class MysqlTwitterRepository implements TwitterRepositoryInterface
{

    /** @var  ConnectionLocator */
    protected $connections;

    /**
     * @param ConnectonLocator $connections
     */
    public function __construct(ConnectionLocator $connections)
    {
        $this->connections = $connections;
    }

    public function getTwitterByTweetId($tweetId)
    {
        $query = "
            SELECT `id`, `tweet_id`, `datetime`, `metadata`
            FROM `jpemeric_stream`.`twitter`
            WHERE `tweet_id` = :tweet_id
            LIMIT 1";

        $bindings = [
            'tweet_id' => $tweetId,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    public function getTwittersUpdatedSince(DateTime $datetime)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`twitter`
            WHERE `updated_at` >= :last_update";

        $bindings = [
            'last_update' => $datetime->format('Y-m-d H:i:s'),
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }

    public function insertTweet($tweetId, DateTime $datetime, array $metadata)
    {
        $query = "
            INSERT INTO `jpemeric_stream`.`twitter`
                (`tweet_id`, `datetime`, `metadata`)
            VALUES
                (:tweet_id, :datetime, :metadata)";

        $bindings = [
            'tweet_id' => $tweetId,
            'datetime' => $datetime->format('Y-m-d H:i:s'),
            'metadata' => json_encode($metadata),
        ];

        return $this
            ->connections
            ->getWrite()
            ->perform($query, $bindings);
    }

    public function updateTweetMetadata($tweetId, array $metadata)
    {
        $query = "
            UPDATE `jpemeric_stream`.`twitter`
            SET `metadata` = :metadata
            WHERE `tweet_id` = :tweet_id";

        $bindings = [
            'metadata' => json_encode($metadata),
            'tweet_id' => $tweetId,
        ];

        return $this
            ->connections
            ->getWrite()
            ->perform($query, $bindings);
    }
}
