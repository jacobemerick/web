<?php

namespace Jacobemerick\Web\Domain\Waterfall\Companion;

use Aura\Sql\ConnectionLocator;

class MysqlCompanionRepository implements CompanionRepositoryInterface
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

    public function getCompanionList()
    {
        $query = "
            SELECT `companion`.`name`, `companion`.`alias`, COUNT(1) AS `count`
            FROM `jpemeric_waterfall`.`companion`
            INNER JOIN `jpemeric_waterfall`.`log_companion_map` ON `log_companion_map`.`companion` = `companion`.`id`
            INNER JOIN `jpemeric_waterfall`.`log` ON `log`.`id` = `log_companion_map`.`log` AND
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
