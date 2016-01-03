<?php

namespace Jacobemerick\Web\Domain\Stream\DailyMile;

use Aura\Sql\ConnectionLocator;
use DateTime;

class MysqlDailyMileRepository implements DailyMileRepositoryInterface
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
    public function getEntries($limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `entry_id`, `datetime`
            FROM `jpemeric_stream`.`dailymile`
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
     * @param integer $entryId
     *
     * @return array|false
     */
    public function getEntryByEntryId($entryId)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`dailymile`
            WHERE `entry_id` = :entry_id
            LIMIT 1";

        $bindings = [
            'entry_id' => $entryId,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    /**
     * @param integer  $entryId
     * @param string   $entryType
     * @param DateTime $datetime
     * @param array    $metadata
     *
     * @return
     */
    public function insertEntry($entryId, $entryType, DateTime $datetime, array $metadata)
    {
        $query = "
            INSERT INTO `jpemeric_stream`.`dailymile`
                (`entry_id`, `type`, `datetime`, `metadata`)
            VALUES
                (:entry_id, :entry_type, :datetime, :metadata)";

        $bindings = [
            'entry_id' => $entryId,
            'entry_type' => $entryType,
            'datetime' => $datetime->format('Y-m-d H:i:s'),
            'metadata' => json_encode($metadata),
        ];

        return $this
            ->connections
            ->getWrite()
            ->perform($query, $bindings);
    }
}
