<?php

namespace Jacobemerick\Web\Domain\Stream\Blog;

use Aura\Sql\ConnectionLocator;

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

    /**
     * @return array|false
     */
    public function getUnmappedBlogs()
    {
        $query = "
            SELECT `id`, `date`
            FROM `jpemeric_stream`.`blog`
            LEFT JOIN `jpemeric_stream`.`post`
            ON `post`.`type_id` = `blog`.`id` AND `post`.`id` IS NULL";

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query);
    }
}
