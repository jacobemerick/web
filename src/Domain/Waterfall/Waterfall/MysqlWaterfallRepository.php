<?php

namespace Jacobemerick\Web\Domain\Waterfall\Waterfall;

use Aura\Sql\ConnectionLocator;

class MysqlWaterfallRepository implements WaterfallRepositoryInterface
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

    public function getWaterfalls($limit = null, $offset = 0)
    {
        $query = "
            SELECT `waterfall`.`id`, `waterfall`.`name`, `waterfall`.`alias`,
                   `watercourse`.`name` AS `watercourse`, `watercourse`.`alias` AS `watercourse_alias`
            FROM `jpemeric_waterfall`.`waterfall`
            INNER JOIN `jpemeric_waterfall`.`watercourse` ON `waterfall`.`watercourse` = `watercourse`.`id`
            WHERE `is_public` = :public
            ORDER BY `name`, `watercourse`";
        if ($limit != null) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }

        $bindings = [
            'public' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }
}
