<?php

namespace Jacobemerick\Web\Domain\Stream\Distance;

use Aura\Sql\ConnectionLocator;
use DateTimeInterface;

class MysqlDistanceRepository implements DistanceRepositoryInterface
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
    public function getDistanceById($id)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`distance`
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
     * @param DateTimeInterface $date
     * @param string            $type
     * @param double            $mileage
     *
     * @return array|false
     */
    public function getDistanceByFields(DateTimeInterface $date, $type, $mileage)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`distance`
            WHERE `date` = :date AND `type` = :type AND `mileage` = :mileage
            LIMIT 1";
        $bindings = [
            'date' => $date->format('Y-m-d H:i:s'),
            'type' => $type,
            'mileage' => $mileage,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    /**
     * @return array|false
     */
    public function getUnmappedDistances()
    {
        $query = "
            SELECT `id`, `date`
            FROM `jpemeric_stream`.`distance`
            LEFT JOIN `jpemeric_stream`.`post`
            ON `post`.`type_id` = `distance`.`id` AND `post`.`id` IS NULL";

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query);
    }
}
