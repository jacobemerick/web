<?php

namespace Jacobemerick\Web\Domain\Stream\BlogComment;

use Aura\Sql\ConnectionLocator;
use DateTime;

class MysqlBlogCommentRepository implements BlogCommentRepositoryInterface
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
     * @param integer $limit
     * @param integer $offset
     *
     * @return array|false
     */
    public function getBlogComments($limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `permalink`, `datetime`
            FROM `jpemeric_stream`.`blog_comment`
            ORDER BY `datetime` DESC";
        if (!is_null($limit)) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query);
    }

    /**
     * @param string $permalink
     *
     * @return array|false
     */
    public function getBlogCommentByPermalink($permalink)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`blog_comment`
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

    public function insertBlogComment($permalink, DateTime $datetime, array $metadata)
    {
        $query = "
            INSERT INTO `jpemeric_stream`.`blog_comment`
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
