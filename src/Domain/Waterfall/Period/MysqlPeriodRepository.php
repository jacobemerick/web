<?php

namespace Jacobemerick\Web\Domain\Waterfall\Period;

use Aura\Sql\ConnectionLocator;

class MysqlPeriodRepository implements PeriodRepositoryInterface
{

    /** @var  Aura\Sql\ConnectionLocator */
    protected $connections;

    /**
     * @param Aura\Sql\ConnectionLocator $connections
     */
    public function __construct(ConnectionLocator $connections)
    {
        $this->connections = $connections;
    }

    public function getPeriodList()
    {
        $query = "
            SELECT `period`.`name`, `period`.`alias`, COUNT(1) AS `count`
            FROM `jpemeric_waterfall`.`period`
            INNER JOIN `jpemeric_waterfall`.`log` ON `log`.`period` = `log`.`id` AND
                                                     `log`.`is_public` = :public
            GROUP BY `alias`
            ORDER BY `name`";

        $bindings = [
            'public' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }
}
