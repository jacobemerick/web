<?php

namespace Jacobemerick\Web\Domain\Stream\Blog;

use Aura\Sql\ConnectionLocator;
use DateTime;

class MysqlBlogRepository implements BlogRepositoryInterface
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

    public function getBlogByPermalink($permalink)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`blog`
            WHERE `permalink` = :permalink
            LIMIT 1";
        $bindings = [
            'permalink' => $permalink,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    public function getBlogsUpdatedSince(DateTime $datetime)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`blog`
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
