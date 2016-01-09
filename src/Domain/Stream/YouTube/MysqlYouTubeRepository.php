<?php

namespace Jacobemerick\Web\Domain\Stream\YouTube;

use Aura\Sql\ConnectionLocator;
use DateTime;

class MysqlYouTubeRepository implements YouTubeRepositoryInterface
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

    public function getYouTubes($limit = null, $offset = 0)
    {
        $query = "
            SELECT `id`, `video_id`, `datetime`
            FROM `jpemeric_stream`.`youtube`
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
     * @param integer $id
     *
     * @return array|false
     */
    public function getYouTubeById($id)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`youtube`
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
     * @param string $title
     *
     * @return array|false
     */
    public function getYouTubeByVideoId($videoId)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`youtube`
            WHERE `video_id` = :video_id
            LIMIT 1";
        $bindings = [
            'video_id' => $videoId,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    public function getYouTubesUpdatedSince(DateTime $datetime)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`youtube`
            WHERE `updated_at` >= :last_update";
        $bindings = [
            'last_update' => $datetime->format('Y-m-d H:i:s'),
        ];
        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }

    public function insertVideo($videoId, DateTime $datetime, array $metadata)
    {
        $query = "
            INSERT INTO `jpemeric_stream`.`youtube`
                (`video_id`, `datetime`, `metadata`)
            VALUES
                (:video_id, :datetime, :metadata)";

        $bindings = [
            'video_id' => $videoId,
            'datetime' => $datetime->format('Y-m-d H:i:s'),
            'metadata' => json_encode($metadata),
        ];

        return $this
            ->connections
            ->getWrite()
            ->perform($query, $bindings);
    }
}
