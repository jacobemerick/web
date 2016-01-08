<?php

namespace Jacobemerick\Web\Domain\Stream\Activity;

use Aura\Sql\ConnectionLocator;
use DateTime;

class MysqlActivityRepository implements ActivityRepositoryInterface
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
    public function getActivityById($id)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`activity`
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

    public function getActivityByTypeId($type, $typeId)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`activity`
            WHERE `type` = :type && `type_id` = :type_id
            LIMIT 1";
        $bindings = [
            'type'    => $type,
            'type_id' => $typeId,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    public function getActivityLastUpdateByType($type)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`activity`
            WHERE `type` = :type
            ORDER BY `updated_at` DESC
            LIMIT 1";

        $bindings = [
            'type' => $type,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    /**
     * @param integer $limit
     * @param integer $offset
     *
     * @return array|false
     */
    public function getActivities($limit = null, $offset = 0)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`activity`
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

    public function getActivitiesCount()
    {
        $query = "
            SELECT COUNT(1) AS `count`
            FROM `jpemeric_stream`.`activity`";

        return $this
            ->connections
            ->getRead()
            ->fetchValue($query);
    }

    public function getActivitiesByType($type, $limit = null, $offset = 0)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`activity`
            WHERE `type` = :type
            ORDER BY `datetime` DESC";
        if (!is_null($limit)) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }
        $bindings = [
            'type' => $type,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }

    public function getActivitiesByTypeCount($type)
    {
        $query = "
            SELECT COUNT(1) AS `count`
            FROM `jpemeric_stream`.`activity`
            WHERE `type` = :type";
        $bindings = [
            'type' => $type,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchValue($query, $bindings);
    }

    public function insertActivity(
        $message,
        $messageLong,
        DateTime $datetime,
        array $metadata,
        $type,
        $typeId
    ) {
        $query = "
            INSERT INTO `jpemeric_stream`.`activity`
                (`message`, `message_long`, `datetime`, `metadata`, `type`, `type_id`)
            VALUES
                (:message, :message_long, :datetime, :metadata, :type, :type_id)";

        $bindings = [
            'message' => $message,
            'message_long' => $messageLong,
            'datetime' => $datetime->format('Y-m-d H:i:s'),
            'metadata' => json_encode($metadata),
            'type' => $type,
            'type_id' => $typeId,
        ];

        return $this
            ->connections
            ->getWrite()
            ->perform($query, $bindings);
    }

    public function updateActivityMetadata($activityId, array $metadata)
    {
        $query = "
            UPDATE `jpemeric_stream`.`activity`
            SET `metadata` = :metadata
            WHERE `id` = :id";

        $bindings = [
            'metadata' => json_encode($metadata),
            'id' => $activityId,
        ];

        return $this
            ->connections
            ->getWrite()
            ->perform($query, $bindings);
    }
}
