<?php

namespace Jacobemerick\Web\Domain\Comment\Comment;

use DateTime;
use Jacobemerick\CommentService\ApiException;
use Jacobemerick\CommentService\Api\DefaultApi;
use Jacobemerick\CommentService\Model\Comment;
use Jacobemerick\CommentService\Model\Commenter;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

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
            [
                'id' => 456,
                'commenter' => [
                    'id' => 456,
                    'name' => 'Joe Black',
                    'website' => 'http://the.inter.net',
                ],
                'body' => 'comment again comment',
                'date' => new DateTime(),
                'url' => 'http://blog.blog.blog/post/#comment-456',
                'reply_to' => 0,
                'thread' => 'comments',
            ],
        ];
    }

    public function testIsInstanceOfServiceCommentRepository()
    {
        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $repository = new ServiceCommentRepository($defaultApi);

        $this->assertInstanceOf(ServiceCommentRepository::class, $repository);
    }

    public function testImplementsCommentRepositoryInterface()
    {
        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $repository = new ServiceCommentRepository($defaultApi);

        $this->assertInstanceOf(CommentRepositoryInterface::class, $repository);
    }

    public function testConstructSetsDefaultApi()
    {
        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $repository = new ServiceCommentRepository($defaultApi);

        $this->assertAttributeSame($defaultApi, 'api', $repository);
    }

    public function testCreateComment()
    {
        $commentData = reset(self::$testCommentList);
        $comment = $this->getCommentObject($commentData);

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('createComment')
            ->with($this->equalTo($commentData))
            ->willReturn($comment);
        $repository = new ServiceCommentRepository($defaultApi);
        $commentResponse = $repository->createComment($commentData);

        $this->assertInternalType('array', $commentResponse);
        $this->assertEquals($commentData, $commentResponse);
    }

    /**
     * @expectedException Jacobemerick\CommentService\ApiException
     */
    public function testCreateCommentFailure()
    {
        $apiException = new ApiException();

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('createComment')
            ->will($this->throwException($apiException));
        $repository = new ServiceCommentRepository($defaultApi);
        $repository->createComment([]);
    }

    public function testGetComment()
    {
        $commentData = reset(self::$testCommentList);
        $comment = $this->getCommentObject($commentData);

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('getComment')
            ->with($this->equalTo($commentData['id']))
            ->willReturn($comment);
        $repository = new ServiceCommentRepository($defaultApi);
        $commentResponse = $repository->getComment($commentData['id']);

        $this->assertInternalType('array', $commentResponse);
        $this->assertEquals($commentData, $commentResponse);
    }

    /**
     * @expectedException Jacobemerick\CommentService\ApiException
     */
    public function testGetCommentFailure()
    {
        $apiException = new ApiException();

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('getComment')
            ->will($this->throwException($apiException));
        $repository = new ServiceCommentRepository($defaultApi);
        $repository->getComment(1);
    }

    public function testGetComments()
    {
        $commentData = self::$testCommentList;
        $comments = array_map([$this, 'getCommentObject'], $commentData);

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('getComments')
            ->with(
                $this->equalTo(null),
                $this->equalTo(null),
                $this->equalTo(null),
                $this->equalTo(null),
                $this->equalTo(null)
            )
            ->willReturn($comments);
        $repository = new ServiceCommentRepository($defaultApi);
        $commentResponse = $repository->getComments();

        $this->assertInternalType('array', $commentResponse);
        $this->assertEquals($commentData, $commentResponse);
    }

    public function testGetCommentsPassesParams()
    {
        $commentData = self::$testCommentList;
        $comments = array_map([$this, 'getCommentObject'], $commentData);

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('getComments')
            ->with(
                $this->equalTo(2),
                $this->equalTo(10),
                $this->equalTo('-date'),
                $this->equalTo('blog.blog.blog'),
                $this->equalTo('post')
            )
            ->willReturn($comments);
        $repository = new ServiceCommentRepository($defaultApi);
        $commentResponse = $repository->getComments('blog.blog.blog', 'post', 2, 10, '-date');

        $this->assertInternalType('array', $commentResponse);
        $this->assertEquals($commentData, $commentResponse);
    }

    /**
     * @expectedException Jacobemerick\CommentService\ApiException
     */
    public function testGetCommentsFailure()
    {
        $apiException = new ApiException();

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('getComments')
            ->will($this->throwException($apiException));
        $repository = new ServiceCommentRepository($defaultApi);
        $repository->getComments();
    }

    public function testDeserializeComment()
    {
        $commentData = reset(self::$testCommentList);
        $comment = $this->getCommentObject($commentData);

        $reflectedRepository = new ReflectionClass(ServiceCommentRepository::class);
        $reflectedDeserializerMethod = $reflectedRepository->getMethod('deserializeComment');
        $reflectedDeserializerMethod->setAccessible(true);

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $repository = new ServiceCommentRepository($defaultApi);
        $commentResponse = $reflectedDeserializerMethod->invokeArgs($repository, [$comment]);

        $this->assertInternalType('array', $commentResponse);
        $this->assertEquals($commentData, $commentResponse);
    }

    protected function getCommentObject($commentData)
    {
        $commentData['commenter'] = new Commenter($commentData['commenter']);
        return new Comment($commentData);
    }
}
