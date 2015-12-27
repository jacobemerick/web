<?php

namespace Jacobemerick\Web\Domain\Stream\Hulu;

use Aura\Sql\ConnectionLocator;

class MysqlHuluRepository implements HuluRepositoryInterface
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
    public function getHuluById($id)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`hulu`
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
}
