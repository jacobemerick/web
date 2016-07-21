<?php

namespace Jacobemerick\Web\Domain\Comment\Comment;

use DateTime;
use Jacobemerick\CommentService\ApiException;
use Jacobemerick\CommentService\Api\DefaultApi;
use Jacobemerick\CommentService\Model\Comment;
use Jacobemerick\CommentService\Model\Commenter;
use PHPUnit_Framework_TestCase;

class ServiceCommentRepositoryTest extends PHPUnit_Framework_TestCase
{

    protected static $testCommentList = [];

    public static function setUpBeforeClass()
    {
        self::$testCommentList = [
            [
                'id' => 123,
                'commenter' => [
                    'id' => 123,
                    'name' => 'Joe Black',
                    'website' => 'http://the.inter.net',
                ],
                'body' => 'comment comment comment',
                'date' => new DateTime(),
                'url' => 'http://blog.blog.blog/post/#comment-123',
                'reply_to' => 12,
                'thread' => 'comments',
            ],
        ];
    }

    public function testIsInstanceOfServiceCommentRepository()
    {
        $defaultApi = $this->createMock(DefaultApi::class);
        $repository = new ServiceCommentRepository($defaultApi);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Comment\Comment\ServiceCommentRepository',
            $repository
        );
    }

    public function testImplementsCommentRepositoryInterface()
    {
        $defaultApi = $this->createMock(DefaultApi::class);
        $repository = new ServiceCommentRepository($defaultApi);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Comment\Comment\CommentRepositoryInterface',
            $repository
        );
    }

    public function testConstructSetsDefaultApi()
    {
        $defaultApi = $this->createMock(DefaultApi::class);
        $repository = new ServiceCommentRepository($defaultApi);

        $this->assertAttributeSame($defaultApi, 'api', $repository);
    }

    public function testCreateComment()
    {
        $commentData = reset(self::$testCommentList);
        $comment = $this->getCommentObject($commentData);

        $defaultApi = $this->createMock(DefaultApi::class);
        $defaultApi->method('createComment')->willReturn($comment);
        $repository = new ServiceCommentRepository($defaultApi);
        $commentResponse = $repository->createComment($commentData);

        $this->assertEquals($commentData, $commentResponse);
    }

    /**
     * @expectedException Jacobemerick\CommentService\ApiException
     */
    public function testCreateCommentFailure()
    {
        $commentData = reset(self::$testCommentList);
        $apiException = new ApiException();

        $defaultApi = $this->createMock(DefaultApi::class);
        $defaultApi->method('createComment')->will($this->throwException($apiException));
        $repository = new ServiceCommentRepository($defaultApi);
        $repository->createComment($commentData);
    }

    public function testGetComment()
    {
        $commentData = reset(self::$testCommentList);
        $comment = $this->getCommentObject($commentData);

        $defaultApi = $this->createMock(DefaultApi::class);
        $defaultApi->method('getComment')->willReturn($comment);
        $repository = new ServiceCommentRepository($defaultApi);
        $commentResponse = $repository->getComment($commentData['id']);

        $this->assertEquals($commentData, $commentResponse);
    }

    /**
     * @expectedException Jacobemerick\CommentService\ApiException
     */
    public function testGetCommentFailure()
    {
        $commentData = reset(self::$testCommentList);
        $apiException = new ApiException();

        $defaultApi = $this->createMock(DefaultApi::class);
        $defaultApi->method('getComment')->will($this->throwException($apiException));
        $repository = new ServiceCommentRepository($defaultApi);
        $repository->getComment($commentData);
    }

    public function testGetComments()
    {
    }

    public function testGetCommentsPassesParams()
    {
    }

    public function testGetCommentsFailure()
    {
    }

    public function testDeserializeComment()
    {
    }

    protected function getCommentObject($commentData)
    {
        $commentData['commenter'] = new Commenter($commentData['commenter']);
        return new Comment($commentData);
    }
}
