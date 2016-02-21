<?php

namespace Jacobemerick\Web\Domain\Blog\Series;

use Aura\Sql\ConnectionLocator;

class MysqlSeriesRepository implements SeriesRepositoryInterface
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
     * @param integer $post
     *
     * @return array|false
     */
    public function getSeriesForPost($post)
    {
        $query = "
            SELECT `series`.`title` AS `series_title`, `series`.`description` AS `series_description`,
                   `post`.`id` AS `post`, `post`.`title`, `post`.`category`, `post`.`path`
            FROM `jpemeric_blog`.`series`
            INNER JOIN `jpemeric_blog`.`series_post` ON `series_post`.`series` = `series`.`id`
            INNER JOIN `jpemeric_blog`.`post` ON `post`.`id` = `series_post`.`post` AND
                                                 `post`.`display` = :is_active
            WHERE `series`.`id` = (
                SELECT `series`
                FROM `jpemeric_blog`.`series_post`
                WHERE `post` = :lookup_post
                LIMIT 1)
            ORDER BY `series_post`.`order`";
        $bindings = [
            'is_active'   => 1,
            'lookup_post' => $post,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }
}
