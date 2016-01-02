<?php

namespace Jacobemerick\Web\Domain\Waterfall\Watercourse;

use Aura\Sql\ConnectionLocator;

class MysqlWatercourseRepository implements WatercourseRepositoryInterface
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

    // todo wot are you even serious
    public function getWatercourseList()
    {
        $query = "
            SELECT `sum_table`.`name`, `sum_table`.`alias`, SUM(`count`) AS `count`
            FROM ((
                SELECT `watercourse`.`name`, `watercourse`.`alias`, `parent_count`.`count`
                FROM (
                    SELECT COUNT(1) AS `count`, `parent` AS `id`
                    FROM `jpemeric_waterfall`.`watercourse`
                    INNER JOIN `jpemeric_waterfall`.`waterfall` ON `waterfall`.`watercourse` = `watercourse`.`id` AND
                                                                   `waterfall`.`is_public` = :public
                    WHERE `watercourse`.`parent` <> :no_parent
                    GROUP BY `watercourse`.`id`
                ) AS `parent_count`
                INNER JOIN `jpemeric_waterfall`.`watercourse` ON `watercourse`.`id` = `parent_count`.`id` AND
                                                                 `watercourse`.`has_page` = :has_page
            ) UNION ALL (
                SELECT `watercourse`.`name`, `watercourse`.`alias`, COUNT(1) AS `count`
                FROM `jpemeric_waterfall`.`watercourse`
                INNER JOIN `jpemeric_waterfall`.`waterfall` ON `waterfall`.`watercourse` = `watercourse`.`id` AND
                                                               `waterfall`.`is_public` = :public
                WHERE `watercourse`.`parent` = :no_parent AND `watercourse`.`has_page` = :has_page
                GROUP BY `watercourse`.`id`
            )) AS `sum_table`
            GROUP BY `alias`
            ORDER BY `name`";

        $bindings = [
            'public' => 1,
            'no_parent' => 0,
            'has_page' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }
}
