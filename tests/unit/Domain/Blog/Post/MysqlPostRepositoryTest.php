<?php

namespace Jacobemerick\Web\Domain\Blog\Post;

use Aura\Sql\ConnectionLocator;
use Aura\Sql\ExtendedPdo;
use DateTime;
use PHPUnit_Framework_TestCase;

class MysqlPostRepositoryTest extends PHPUnit_Framework_TestCase
{

    protected static $connection;

    public static function setUpBeforeClass()
    {
        $extendedPdo = new ExtendedPdo('sqlite::memory:');
        $extendedPdo->exec('ATTACH DATABASE `jpemeric_blog.db` AS `jpemeric_blog`');

        $extendedPdo->exec("
            CREATE TABLE IF NOT EXISTS `jpemeric_blog`.`post` (
              `id` integer PRIMARY KEY AUTOINCREMENT,
              `title` varchar(60) NOT NULL,
              `path` varchar(60) NOT NULL,
              `category` varchar(20) NOT NULL,
              `date` date NOT NULL,
              `body` text NOT NULL,
              `display` integer NOT NULL
            )"
        );

        self::$connection = new ConnectionLocator(function () use ($extendedPdo) {
            return $extendedPdo;
        });
    }

    public function testIsInstanceOfPostRepository()
    {
        $repository = new MysqlPostRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository',
            $repository
        );
    }

    public function testImplementsPostInterface()
    {
        $repository = new MysqlPostRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Blog\Post\PostRepositoryInterface',
            $repository
        );
    }

    public function testConstructSetsConnections()
    {
        $respository = new MysqlPostRepository(self::$connection);

        $this->assertAttributeSame(
            self::$connection,
            'connections',
            $respository
        );
    }

    public function testFindPostByPath()
    {
        $testData = [
            'id'       => rand(1, 100),
            'title'    => 'test title',
            'path'     => 'test-path',
            'category' => 'test category',
            'date'     => (new DateTime())->format('Y-m-d H:i:s'),
            'body'     => 'test body',
            'display'  => 1
        ];

        $this->insertPostData($testData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->findPostByPath($testData['category'], $testData['path']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('id', $data);
        $this->assertEquals($testData['id'], $data['id']);
        $this->assertArrayHasKey('title', $data);
        $this->assertEquals($testData['title'], $data['title']);
        $this->assertArrayHasKey('path', $data);
        $this->assertEquals($testData['path'], $data['path']);
        $this->assertArrayHasKey('date', $data);
        $this->assertEquals($testData['date'], $data['date']);
        $this->assertArrayHasKey('body', $data);
        $this->assertEquals($testData['body'], $data['body']);
        $this->assertArrayHasKey('category', $data);
        $this->assertEquals($testData['category'], $data['category']);
    }

    public function testFindPostByPathInactive()
    {
        $testData = [
            'id'       => rand(1, 100),
            'path'     => 'test-path',
            'category' => 'test category',
            'display'   => 0
        ];

        $this->insertPostData($testData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->findPostByPath($testData['category'], $testData['path']);

        $this->assertFalse($data);
    }

    public function testFindPostByPathFailure()
    {
        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->findPostByPath('', '');

        $this->assertFalse($data);
    }

    protected function insertPostData(array $data)
    {
        $defaultData = [
            'id' => null,
            'title' => '',
            'path' => '',
            'category' => '',
            'date' => '',
            'body' => '',
            'display' => 0,
        ];

        $data = array_merge($defaultData, $data);

        return self::$connection->getDefault()->perform("
            INSERT INTO `jpemeric_blog`.`post`
                (id, title, path, category, date, body, display)
            VALUES
                (:id, :title, :path, :category, :date, :body, :display)",
            $data
        );
    }

    protected function tearDown()
    {
        self::$connection->getDefault()->perform("DELETE FROM `jpemeric_blog`.`post`");
    }

    public static function tearDownAfterClass()
    {
        self::$connection->getDefault()->disconnect();
        unlink('jpemeric_blog.db');
    }
}
