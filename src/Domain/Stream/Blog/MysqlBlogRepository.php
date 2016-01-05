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

    /**
     * @param integer $id
     *
     * @return array|false
     */
    public function getBlogById($id)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`blog`
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

    public function getBlogByPermalink($permalink)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`blog2`
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

    /**
     * @param string $title
     *
     * @return array|false
     */
    public function getBlogByTitle($title)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`blog`
            WHERE `title` = :title
            LIMIT 1";
        $bindings = [
            'title' => $title,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    public function getBlogs($limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `permalink`, `datetime`
            FROM `jpemeric_stream`.`blog2`
            ORDER BY `datetime` DESC";
        if (!is_null($limit)) {
            $query .= "
            LIMIT {$limit}, {$offset}";
        }

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query);
    }

    public function insertBlog($permalink, DateTime $datetime, array $metadata)
    {
        $query = "
            INSERT INTO `jpemeric_stream`.`blog2`
                (`permalink`, `datetime`, `metadata`)
            VALUES
                (:permalink, :datetime, :metadata)";

        $bindings = [
            'permalink' => $permalink,
            'datetime' => $datetime->format('Y-m-d H:i:s'),
            'metadata' => json_encode($metadata),
        ];

        return $this
            ->connections
            ->getWrite()
            ->perform($query, $bindings);
    }
}
