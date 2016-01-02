<?php

namespace Jacobemerick\Web\Domain\Waterfall\Log;

use Aura\Sql\ConnectionLocator;

class MysqlLogRepository implements LogRepositoryInterface
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

    public function getActiveLogs($limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `title`, `alias`, `date`, `publish_date`, `introduction`
            FROM `jpemeric_waterfall`.`log`
            WHERE `is_public` = :public
            ORDER BY `date` DESC";
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
