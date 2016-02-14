<?php

namespace Jacobemerick\Web\Domain\Stream\Activity;

use Aura\Sql\ConnectionLocator;

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
}
