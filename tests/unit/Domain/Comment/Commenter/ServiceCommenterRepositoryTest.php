<?php

namespace Jacobemerick\Web\Domain\Comment\Commenter;

use Jacobemerick\CommentService\ApiException;
use Jacobemerick\CommentService\Api\DefaultApi;
use Jacobemerick\CommentService\Model\Commenter;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

class ServiceCommenterRepositoryTest extends PHPUnit_Framework_TestCase
{

    protected static $testCommenterList = [];

    public static function setUpBeforeClass()
    {
        self::$testCommenterList = [
            [
                'id' => 123,
                'name' => 'Joe Black',
                'website' => 'http://the.inter.net',
            ],
            [
                'id' => 456,
                'name' => 'Joe Black',
                'website' => 'http://the.inter.net',
            ],
        ];
    }

    public function testIsInstanceOfServiceCommenterRepository()
    {
        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $repository = new ServiceCommenterRepository($defaultApi);

        $this->assertInstanceOf(ServiceCommenterRepository::class, $repository);
    }

    public function testImplementsCommentRepositoryInterface()
    {
        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $repository = new ServiceCommenterRepository($defaultApi);

        $this->assertInstanceOf(CommenterRepositoryInterface::class, $repository);
    }

    public function testConstructSetsDefaultApi()
    {
        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $repository = new ServiceCommenterRepository($defaultApi);

        $this->assertAttributeSame($defaultApi, 'api', $repository);
    }

    public function testGetCommenter()
    {
        $commenterData = reset(self::$testCommenterList);
        $commenter = new Commenter($commenterData);

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('getCommenter')
            ->with($this->equalTo($commenterData['id']))
            ->willReturn($commenter);
        $repository = new ServiceCommenterRepository($defaultApi);
        $commenterResponse = $repository->getCommenter($commenterData['id']);

        $this->assertInternalType('array', $commenterResponse);
        $this->assertEquals($commenterData, $commenterResponse);
    }

    /**
     * @expectedException Jacobemerick\CommentService\ApiException
     */
    public function testGetCommenterFailure()
    {
        $apiException = new ApiException();

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('getCommenter')
            ->will($this->throwException($apiException));
        $repository = new ServiceCommenterRepository($defaultApi);
        $repository->getCommenter(1);
    }

    public function testGetCommenters()
    {
        $commenterData = self::$testCommenterList;
        $commenters = array_map(function ($data) {
            return new Commenter($data);
        }, $commenterData);

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('getCommenters')
            ->with(
                $this->equalTo(null),
                $this->equalTo(null)
            )
            ->willReturn($commenters);
        $repository = new ServiceCommenterRepository($defaultApi);
        $commenterResponse = $repository->getCommenters();

        $this->assertInternalType('array', $commenterResponse);
        $this->assertEquals($commenterData, $commenterResponse);
    }

    public function testGetCommentersPassesParams()
    {
        $commenterData = self::$testCommenterList;
        $commenters = array_map(function ($data) {
            return new Commenter($data);
        }, $commenterData);

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('getCommenters')
            ->with(
                $this->equalTo(2),
                $this->equalTo(10)
            )
            ->willReturn($commenters);
        $repository = new ServiceCommenterRepository($defaultApi);
        $commenterResponse = $repository->getCommenters(2, 10);

        $this->assertInternalType('array', $commenterResponse);
        $this->assertEquals($commenterData, $commenterResponse);
    }

    /**
     * @expectedException Jacobemerick\CommentService\ApiException
     */
    public function testGetCommentersFailure()
    {
        $apiException = new ApiException();

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $defaultApi->method('getCommenters')
            ->will($this->throwException($apiException));
        $repository = new ServiceCommenterRepository($defaultApi);
        $repository->getCommenters();
    }

    public function testDeserializeCommenter()
    {
        $commenterData = reset(self::$testCommenterList);
        $commenter = new Commenter($commenterData);

        $reflectedRepository = new ReflectionClass(ServiceCommenterRepository::class);
        $reflectedDeserializerMethod = $reflectedRepository->getMethod('deserializeCommenter');
        $reflectedDeserializerMethod->setAccessible(true);

        $defaultApi = $this->getMockBuilder(DefaultApi::class)
            ->getMock();
        $repository = new ServiceCommenterRepository($defaultApi);
        $commenterResponse = $reflectedDeserializerMethod->invokeArgs($repository, [$commenter]);

        $this->assertInternalType('array', $commenterResponse);
        $this->assertEquals($commenterData, $commenterResponse);
    }
}
