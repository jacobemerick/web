<?php

namespace Jacobemerick\Web\Domain\Blog;

use Aura\Sql\ConnectionLocator;

class MysqlPostRepository implements PostRepository
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
    public function findByPath($category, $path)
    {
        $query = "
            SELECT `id`, `title`, `path`, `date`, `body`, `category`
            FROM `jpemeric_blog`.`post`
            WHERE `path` = :path AND `category` = :category AND `display` = :is_active
            LIMIT 1";
        $bindings = array(
            'path'      => $path,
            'category'  => $category,
            'is_active' => 1,
        );

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }
}
