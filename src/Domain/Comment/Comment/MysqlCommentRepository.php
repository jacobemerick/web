<?php

namespace Jacobemerick\Web\Domain\Comment\Comment;

use Aura\Sql\ConnectionLocator;

class MysqlCommentRepository implements CommentRepositoryInterface
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

    public function getActiveCommentsBySite($site, $limit = null, $offset = 0)
    {
        if ($site == 'blog') {
            $site_id = 2;
        } else {
            throw new Exception('Unrecognized site id in comment repository');
        }

        $query = "
            SELECT `comment_meta`.`id`, `comment_meta`.`date`, `comment`.`body`, `commenter`.`name`,
                   `post`.`title`, `post`.`category`, `post`.`path`
            FROM `jpemeric_comment`.`comment_meta`
            INNER JOIN `jpemeric_comment`.`comment` ON `comment`.`id` = `comment_meta`.`comment`
            INNER JOIN `jpemeric_comment`.`commenter` ON `commenter`.`id` = `comment_meta`.`commenter` AND
                                                         `commenter`.`trusted` = :trusted_commenter
            INNER JOIN `jpemeric_comment`.`comment_page` ON `comment_page`.`id` = `comment_meta`.`comment_page` AND
                                                            `comment_page`.`site` = :comment_site
            INNER JOIN `jpemeric_blog`.`post` ON `post`.`path` = `comment_page`.`path` AND
                                                 `post`.`display` = :display_post
            WHERE `comment_meta`.`display` = :active_comment
            ORDER BY `comment_meta`.`date` DESC";
        if ($limit != null) {
            $query .= "
            LIMIT {$offset}, {$limit}";
        }

        $bindings = [
            'trusted_commenter' => 1,
            'comment_site' => $site_id,
            'display_post' => 1,
            'active_comment' => 1,
        ];

        return $this
            ->connections
            ->getRead()
            ->fetchAll($query, $bindings);
    }
}
