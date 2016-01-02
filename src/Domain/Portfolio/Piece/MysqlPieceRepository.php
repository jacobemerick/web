<?php

namespace Jacobemerick\Web\Domain\Portfolio\Piece;

use Aura\Sql\ConnectionLocator;

class MysqlPieceRepository implements PieceRepositoryInterface
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

    public function getPieces($limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `title`, `title_url`, `category`
            FROM `jpemeric_portfolio`.`piece`
            WHERE `display` = :is_active
            ORDER BY `date` DESC";
        if ($limit != null) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }

        $bindings = [
            'is_active' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }
}
