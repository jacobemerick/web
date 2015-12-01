<?php

namespace Jacobemerick\Web\Domain\Blog;

use Aura\Sql\ConnectionLocator;

class MysqlTagRepository implements TagRepository
{

    /** @var  Aura\Sql\ConnectionLocator */
    protected $connections;

    /**
     * @param Aura\Sql\ConnectionLocator
     */
    public function __construct(ConnectionLocator $connections)
    {
        $this->connections = $connections;
    }

    /**
     * @param string $title
     *
     * @return array|false
     */
    public function findTagByTitle($title)
    {
        $query = "
            SELECT *
            FROM `jpemeric_blog`.`tag`
            WHERE `tag` = :title
            LIMIT 1";
        $bindings = [
            'title' => $title,
        ];

        return $this
            ->connections()
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    public function getAllTags()
    {
        $query = "
            SELECT *
            FROM `jpemeric_blog`.`tag`
            ORDER BY `tag`";

        return $this
            ->connections()
            ->getRead()
            ->fetchAll($query);
    }

    public function getTagCloud()
    {
        $query = "
            SELECT COUNT(1) AS `count`, `tag`
            FROM `jpemeric_blog`.`tag`
            INNER JOIN `jpemeric_blog`.`ptlink` ON `ptlink`.`tag_id` = `tag`.`id`
            INNER JOIN `jpemeric_blog`.`post` ON `post`.`id` = `ptlink`.`post_id` AND
                                                 `post`.`display` = :is_active
            GROUP BY `tag`";
        $bindings = [
            'is_active' => 1,
        ];

        return $this
            ->connections()
            ->getRead()
            ->fetchAll($query, $bindings);
    }

    public function getTagsForPost($post)
    {
        $query = "
            SELECT `tag`.*
            FROM `jpemeric_blog`.`tag`
            INNER JOIN `jpemeric_blog`.`ptlink` ON `ptlink`.`tag_id` AND `post_id` = :post
            ORDER BY `tag`";
        $bindings = [
            'post' => $post,
        ];

        return $this
            ->connections()
            ->getRead()
            ->fetchAll($query, $bindings);
}
