<?php

namespace Jacobemerick\Web\Domain\Stream\Github;

use Aura\Sql\ConnectionLocator;
use DateTime;

class MysqlGithubRepository implements GithubRepositoryInterface
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
     * @param integer $limit
     * @param integer $offset
     *
     * @return array|false
     */
    public function getEvents($limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `event_id`, `datetime`
            FROM `jpemeric_stream`.`github`
            ORDER BY `datetime` DESC";
        if (!is_null($limit)) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query);
    }

    /**
     * @param integer $eventId
     *
     * @return array|false
     */
    public function getEventByEventId($eventId)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`github`
            WHERE `event_id` = :event_id
            LIMIT 1";

        $bindings = [
            'event_id' => $eventId,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    public function getGithubsUpdatedSince(DateTime $datetime)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`github`
            WHERE `updated_at` >= :last_update";
        $bindings = [
            'last_update' => $datetime->format('Y-m-d H:i:s'),
        ];
        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }

    /**
     * @param integer  $eventId
     * @param string   $eventType
     * @param DateTime $datetime
     * @param array    $metadata
     *
     * @return
     */
    public function insertEvent($eventId, $eventType, DateTime $datetime, array $metadata)
    {
        $query = "
            INSERT INTO `jpemeric_stream`.`github`
                (`event_id`, `type`, `datetime`, `metadata`)
            VALUES
                (:event_id, :event_type, :datetime, :metadata)";

        $bindings = [
            'event_id' => $eventId,
            'event_type' => $eventType,
            'datetime' => $datetime->format('Y-m-d H:i:s'),
            'metadata' => json_encode($metadata),
        ];

        return $this
            ->connections
            ->getWrite()
            ->perform($query, $bindings);
    }
}
