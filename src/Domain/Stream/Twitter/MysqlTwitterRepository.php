<?php

namespace Jacobemerick\Web\Domain\Stream\Twitter;

use Aura\Sql\ConnectionLocator;
use DateTimeInterface;

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

    /**
     * @param integer $id
     *
     * @return array|false
     */
    public function getTwitterById($id)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`twitter`
            WHERE `id` = :id
            LIMIT 1";
        $bindings = [
            'id' => $id,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    public function getTwitterByTweetId($tweetId)
    {
        $query = "
            SELECT `id`, `tweet_id`, `datetime`, `metadata`
            FROM `jpemeric_stream`.`twitter2`
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

    /**
     * @param DateTimeInterface $date
     * @param string            $text
     *
     * @return array|false
     */
    public function getTwitterByFields(DateTimeInterface $date, $text)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`twitter`
            WHERE `date` = :date AND `text` = :text
            LIMIT 1";
        $bindings = [
            'date' => $date->format('Y-m-d H:i:s'),
            'text' => $text,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    /**
     * @return array|false
     */
    public function getUnmappedTwitters()
    {
        $query = "
            SELECT `id`, `date`
            FROM `jpemeric_stream`.`twitter`
            LEFT JOIN `jpemeric_stream`.`post`
            ON `post`.`type_id` = `twitter`.`id` AND `post`.`id` IS NULL";

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query);
    }

    public function insertTweet($tweetId, DateTimeInterface $datetime, array $metadata)
    {
        $query = "
            INSERT INTO `jpemeric_stream`.`twitter2`
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
            UPDATE `jpemeric_stream`.`twitter2`
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
