<?php

namespace Jacobemerick\Web\Domain\Comment\Comment;

use Jacobemerick\CommentService\Api\DefaultApi;
use Jacobemerick\CommentService\Model\Comment;

class ServiceCommentRepository implements CommentRepositoryInterface
{

    /**
     * @var Jacobemerick\CommentService\Api\DefaultApi
     */
    protected $api;

    /**
     * @param Jacobemerick\CommentService\Api\DefaultApi $api
     */
    public function __construct(DefaultApi $api)
    {
        $this->api = $api;
    }

    /**
     * @param array $comment
     * @return array
     * @throws Jacobemerick\CommentService\ApiException
     */
    public function createComment(array $comment)
    {
        $response = $this->api->createComment($comment);
        return $this->deserializeComment($response);
    }

    /**
     * @param integer $commentId
     * @return array
     * @throws Jacobemerick\CommentService\ApiException
     */
    public function getComment($commentId)
    {
        $response = $this->api->getComment($commentId);
        return $this->deserializeComment($response);
    }

    /**
     * @param string $domain
     * @param string $path
     * @param integer $page
     * @param integer $perPage
     * @param string $order
     * @return array
     * @throws Jacobemerick\CommentService\ApiException
     */
    public function getComments($domain = null, $path = null, $page = null, $perPage = null, $order = null)
    {
        $response = $this->api->getComments($page, $perPage, $order, $domain, $path);
        return array_map([$this, 'deserializeComment'], $response);
    }

    /**
     * @param Jacobemerick\CommentService\Model\Comment $comment
     * @return array
     */
    protected function deserializeComment(Comment $comment)
    {
        return [
            'id' => $comment->getId(),
            'commenter' => [
                'id' => $comment->getCommenter()->getId(),
                'name' => $comment->getCommenter()->getName(),
                'website' => $comment->getCommenter()->getWebsite(),
            ],
            'body' => $comment->getBody(),
            'date' => $comment->getDate(),
            'url' => $comment->getUrl(),
            'reply_to' => $comment->getReplyTo(),
            'thread' => $comment->getThread(),
        ];
    }
}
