<?php

namespace Jacobemerick\Web\Domain\Stream\Changelog;

use Aura\Sql\ConnectionLocator;

class MysqlChangelogRepository implements ChangelogRepositoryInterface
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
     * @param integer $limit
     * @param integer $offset
     *
     * @return array|false
     */
    public function getChanges($limit = null, $offset = 0)
    {
        $query = "
            SELECT `message`, `message_short`, `datetime`, `commit_link`
            FROM `jpemeric_stream`.`changelog`
            ORDER BY `datetime` DESC";
        if (!is_null($limit)) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query);
    }
}
