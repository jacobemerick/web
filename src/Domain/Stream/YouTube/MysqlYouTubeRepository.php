<?php

namespace Jacobemerick\Web\Domain\Stream\YouTube;

use Aura\Sql\ConnectionLocator;

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

    /**
     * @return array|false
     */
    public function getUnmappedYouTubes()
    {
        $query = "
            SELECT `id`, `date`
            FROM `jpemeric_stream`.`youtube`
            LEFT JOIN `jpemeric_stream`.`post`
            ON `post`.`type_id` = `youtube`.`id` AND `post`.`id` IS NULL";

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query);
    }
}
