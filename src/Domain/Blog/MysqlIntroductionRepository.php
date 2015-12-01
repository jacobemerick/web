<?php

namespace Jacobemerick\Web\Domain\Blog;

use Aura\Sql\ConnectionLocator;

class MysqlIntroductionRepository implements IntroductionRepository
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
     * @param string $type
     * @param string $value
     *
     * @return array|false
     */
    public function findByType($type, $value = '')
    {
        $query = "
            SELECT `title`, `content`, `image`
            FROM `jpemeric_blog`.`introduction`
            WHERE `type` = :type AND `value` = :value
            LIMIT 1";
        $bindings = [
            'type'  => $type,
            'value' => $value,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }
}
