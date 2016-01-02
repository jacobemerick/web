<?php

namespace Jacobemerick\Web\Domain\Waterfall\County;

use Aura\Sql\ConnectionLocator;

class MysqlCountyRepository implements CountyRepositoryInterface
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

    public function getCountyList()
    {
        $query = "
            SELECT `county`.`name`, `county`.`alias`, COUNT(1) AS `count`
            FROM `jpemeric_waterfall`.`county`
            INNER JOIN `jpemeric_waterfall`.`waterfall` ON `waterfall`.`county` = `county`.`id` AND
                                                           `waterfall`.`is_public` = :public
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
