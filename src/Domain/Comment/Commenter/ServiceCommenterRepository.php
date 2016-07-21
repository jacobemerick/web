<?php

namespace Jacobemerick\Web\Domain\Comment\Commenter;

use Jacobemerick\CommentService\ApiException;
use Jacobemerick\CommentService\Api\DefaultApi;
use Jacobemerick\CommentService\Model\Commenter;

class ServiceCommenterRepository implements CommenterRepositoryInterface
{

    /**
     * @var DefaultApi
     */
    protected $api;

    /**
     * @param DefaultApi $api
     */
    public function __construct(DefaultApi $api)
    {
        $this->api = $api;
    }

    /**
     * @param array $commenter
     * @return array
     * @throws ApiException
     */
    public function createCommenter(array $commenter)
    {
        $response = $this->api->createCommenter($commenter);
        return $this->deserializeCommenter($response);
    }

    /**
     * @param integer $commenterId
     * @return array
     * @throws ApiException
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
     * @throws ApiException
     */
    public function getCommenters($page = null, $perPage = null)
    {
        $response = $this->api->getCommenters($page, $perPage);
        return array_map([$this, 'deserializeCommenter'], $response);
    }

    /**
     * @param Commenter
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
