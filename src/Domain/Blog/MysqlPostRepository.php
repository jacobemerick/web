<?php

namespace Jacobemerick\Web\Domain\Blog;

use Aura\Sql\ConnectionLocator;

class MysqlPostRepository implements PostRepository
{

    protected $connections;

    public function __construct(ConnectionLocator $connections)
    {
        $this->connections = $connections;
    }

    // todo make this smarter - it should parse by category as well
    public function findByUri($uri)
    {
        $query = "
            SELECT `id`, `title`, `path`, `date`, `body`, `category`
            FROM `jpemeric_blog`.`post`
            WHERE `path` = :uri AND `display` = '1'
            LIMIT 1";
        $bindings = array(
            'uri' => $uri
        );
        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }
}
