<?php

namespace Jacobemerick\Web\Domain\Stream\Post;

use Aura\Sql\ConnectionLocator;

class MysqlPostRepository implements PostRepositoryInterface
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
    public function getPostById($id)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`post`
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
     * @param string  $type
     * @param integer $type_id
     *
     * @return array|false
     */
    public function getPostByFields($type, $type_id)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`post`
            WHERE `type` = :type && `type_id` = :type_id
            LIMIT 1";
        $bindings = [
            'type'    => $type,
            'type_id' => $type_id,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    /**
     * @param integer $limit
     * @param integer $offset
     *
     * @return array|false
     */
    public function getPosts($limit = null, $offset = 0)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`post`
            ORDER BY `date` DESC";
        if (!is_null($limit)) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query);
    }

    public function getPostsCount()
    {
        $query = "
            SELECT COUNT(1) AS `count`
            FROM `jpemeric_stream`.`post`";

        return $this
            ->connections
            ->getRead()
            ->fetchValue($query);
    }

    public function getPostsByType($type, $limit = null, $offset = 0)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`post`
            WHERE `type` = :type
            ORDER BY `date` DESC";
        if (!is_null($limit)) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }
        $bindings = [
            'type' => $type,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }

    public function getPostsByTypeCount($type)
    {
        $query = "
            SELECT COUNT(1) AS `count`
            FROM `jpemeric_stream`.`post`
            WHERE `type` = :type";
        $bindings = [
            'type' => $type,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchValue($query, $bindings);
    }
}
