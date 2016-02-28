<?php

namespace Jacobemerick\Web\Domain\Blog\Post;

use Aura\Sql\ConnectionLocator;

class MysqlPostRepository implements PostRepositoryInterface
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

    /**
     * @param string $category
     * @param string $path
     *
     * @return array|false
     */
    public function findPostByPath($category, $path)
    {
        $query = "
            SELECT `id`, `title`, `path`, `date`, `body`, `category`
            FROM `jpemeric_blog`.`post`
            WHERE `path` = :path AND `category` = :category AND `display` = :is_active
            LIMIT 1";
        $bindings = [
            'path'      => $path,
            'category'  => $category,
            'is_active' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    public function getActivePosts($limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `title`, `path`, `date`, `body`, `category`
            FROM `jpemeric_blog`.`post`
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

    public function getActivePostsCount()
    {
        $query = "
            SELECT COUNT(1) AS `count`
            FROM `jpemeric_blog`.`post`
            WHERE `display` = :is_active";
        $bindings = [
            'is_active' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchValue($query, $bindings);
    }

    public function getActivePostsByTag($tag, $limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `title`, `path`, `date`, `body`, `category`
            FROM `jpemeric_blog`.`post`
            INNER JOIN `jpemeric_blog`.`ptlink` ON `ptlink`.`post_id` = `post`.`id` AND
                                                   `ptlink`.`tag_id` = :tag_id
            WHERE `display` = :is_active";
        if ($limit != null) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }

        $bindings = [
            'tag_id'    => $tag,
            'is_active' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }

    public function getActivePostsCountByTag($tag)
    {
        $query = "
            SELECT COUNT(1) AS `count`
            FROM `jpemeric_blog`.`post`
            INNER JOIN `jpemeric_blog`.`ptlink` ON `ptlink`.`post_id` = `post`.`id` AND
                                                   `ptlink`.`tag_id` = :tag_id
            WHERE `display` = :is_active";
        $bindings = [
            'tag_id'    => $tag,
            'is_active' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchValue($query, $bindings);
    }

    public function getActivePostsByCategory($category, $limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `title`, `path`, `date`, `body`, `category`
            FROM `jpemeric_blog`.`post`
            WHERE `category` = :category AND `display` = :is_active";
        if ($limit != null) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }

        $bindings = [
            'category'  => $category,
            'is_active' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }

    public function getActivePostsCountByCategory($category)
    {
        $query = "
            SELECT COUNT(1) AS `count`
            FROM `jpemeric_blog`.`post`
            WHERE `category` = :category AND `display` = :is_active";
        $bindings = [
            'category'  => $category,
            'is_active' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchValue($query, $bindings);
    }

    public function getActivePostsByRelatedTags($post, $limit = 4)
    {
        $query = "
            SELECT `id`, `title`, `path`, `date`, `body`, `category`, COUNT(1) AS `count`
            FROM `jpemeric_blog`.`post`
            INNER JOIN `jpemeric_blog`.`ptlink` ON `ptlink`.`post_id` = `post`.`id` AND
                                                   `ptlink`.`tag_id` IN (
                SELECT `id`
                FROM `jpemeric_blog`.`tag`
                INNER JOIN `jpemeric_blog`.`ptlink` ON `ptlink`.`tag_id` = `tag`.`id` AND
                                                       `ptlink`.`post_id` = :post)
            WHERE `id` <> :post AND `id` NOT IN (
                SELECT `post`
                FROM `jpemeric_blog`.`series_post`
                WHERE `series` = (
                    SELECT `series`
                    FROM `jpemeric_blog`.`series_post`
                    WHERE `post` = :post
                )) AND `display` = :is_active
            GROUP BY `id`
            ORDER BY `count` DESC
            LIMIT {$limit}";
        $bindings = [
            'post'      => $post,
            'is_active' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }
}
