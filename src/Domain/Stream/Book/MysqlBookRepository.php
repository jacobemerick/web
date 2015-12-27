<?php

namespace Jacobemerick\Web\Domain\Stream\Book;

use Aura\Sql\ConnectionLocator;

class MysqlBookRepository implements BookRepositoryInterface
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
    public function getBookById($id)
    {
        $query = "
            SELECT `id`, `title`, `author`, `image`, `date_read` AS `date`
            FROM `jpemeric_stream`.`book`
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
     * @param string $author
     *
     * @return array|false
     */
    public function getBookByFields($title, $author)
    {
        $query = "
            SELECT *
            FROM `jpemeric_stream`.`book`
            WHERE `title` = :title AND `author` = :author
            LIMIT 1";
        $bindings = [
            'title' => $title,
            'author' => $author,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchOne($query, $bindings);
    }

    /**
     * @return array|false
     */
    public function getUnmappedBooks()
    {
        $query = "
            SELECT `id`, `date`
            FROM `jpemeric_stream`.`book`
            LEFT JOIN `jpemeric_stream`.`post`
            ON `post`.`type_id` = `book`.`id` AND `post`.`id` IS NULL";

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query);
    }
}
