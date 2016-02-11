<?php

namespace Jacobemerick\Web\Domain\Stream\DailyMile;

use Aura\Sql\ConnectionLocator;
use DateTime;

class MysqlDailyMileRepository implements DailyMileRepositoryInterface
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

    public function getDailyMilesUpdatedSince(DateTime $datetime)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`dailymile`
            WHERE `updated_at` >= :last_update";

        $bindings = [
            'last_update' => $datetime->format('Y-m-d H:i:s'),
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }
}
