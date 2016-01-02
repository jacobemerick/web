<?php

namespace Jacobemerick\Web\Domain\Stream\Changelog;

use Aura\Sql\ConnectionLocator;
use DateTime;

class MysqlChangelogRepository implements ChangelogRepositoryInterface
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
    public function getChanges($limit = null, $offset = 0)
    {
        $query = "
            SELECT `message`, `message_short`, `datetime`, `commit_link`
            FROM `jpemeric_stream`.`changelog`
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
     * @param string $hash
     *
     * @return array|false
     */
    public function getChangeByHash($hash)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`changelog`
            WHERE `hash` = :hash
            LIMIT 1";

        $bindings = [
            'hash' => $hash,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    /**
     * @param string   $hash
     * @param string   $message
     * @param DateTime $datetime
     * @param string   $author
     * @param string   $commit_link
     *
     * @return
     */
    public function insertChange($hash, $message, DateTime $datetime, $author, $commit_link)
    {
        $message_short = $message;
        $message_short = strtok($message_short, "\n");
        if (strlen($message_short) > 72) {
            $message_short = wordwrap($message_short, 65);
            $message_short = strtok($message_short, "\n");
            $message_short .= '...';
        }

        $query = "
            INSERT INTO `jpemeric_stream`.`changelog`
                (`hash`, `message`, `message_short`, `datetime`, `author`, `commit_link`)
            VALUES
                (:hash, :message, :message_short, :datetime, :author, :commit_link)";

        $bindings = [
            'hash' => $hash,
            'message' => $message,
            'message_short' => $message_short,
            'datetime' => $datetime->format('Y-m-d H:i:s'),
            'author' => $author,
            'commit_link' => $commit_link
        ];

        return $this
            ->connections
            ->getWrite()
            ->perform($query, $bindings);
    }
}
