<?php

namespace Jacobemerick\Web\Domain\Stream\Goodread;

use Aura\Sql\ConnectionLocator;
use DateTime;

class MysqlGoodreadRepository implements GoodreadRepositoryInterface
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
    public function getReviews($limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `permalink`, `datetime`
            FROM `jpemeric_stream`.`goodread`
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

    public function getReviewByPermalink($permalink)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`goodread`
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

    public function insertReview($permalink, $bookId, DateTime $datetime, array $metadata)
    {
        $query = "
            INSERT INTO `jpemeric_stream`.`goodread`
                (`permalink`, `book_id`, `datetime`, `metadata`)
            VALUES
                (:permalink, :book_id, :datetime, :metadata)";

        $bindings = [
            'permalink' => $permalink,
            'book_id' => $bookId,
            'datetime' => $datetime->format('Y-m-d H:i:s'),
            'metadata' => json_encode($metadata),
        ];

        return $this
            ->connections
            ->getWrite()
            ->perform($query, $bindings);
    }
}
