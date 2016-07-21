<?php

namespace Jacobemerick\Web\Domain\Comment\Commenter;

use Jacobemerick\CommentService\Api\DefaultApi;
use Jacobemerick\CommentService\Model\Comment;

class ServiceCommenterRepository implements CommenterRepositoryInterface
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
     * @param array $commenter
     * @return array
     * @throws Jacobemerick\CommentService\ApiException
     */
    public function createCommenter(array $commenter)
    {
        $response = $this->api->createCommenter($commenter);
        return $this->deserializeCommenter($response);
    }

    /**
     * @param integer $commenterId
     * @return array
     * @throws Jacobemerick\CommentService\ApiException
     */
    public function getCommenter($commenterId)
    {
        $response = $this->api->getCommenter($commenterId);
        return $this->deserializeCommenter($response);
    }

    /**
     * @param integer $page
     * @param integer $perPage
     * @return array
     * @throws Jacobemerick\CommentService\ApiException
     */
    public function getCommenters($page = null, $perPage = null)
    {
        $response = $this->api->getCommenters($page, $perPage);
        return $this->deserializeCommenter($response);
    }

    /**
     * @param Jacobemerick\CommentService\Model\Commenter
     * @return array
     */
    protected function deserializeCommenter(Commenter $commenter)
    {
        return [
            'id' => $commenter->getId(),
            'name' => $commenter->getName(),
            'website' => $commenter->getWebsite(),
        ];
    }
}
