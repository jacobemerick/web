<?php

namespace Jacobemerick\Web\Domain\Blog\Series;

use Aura\Sql\ConnectionLocator;
use Aura\Sql\ExtendedPdo;
use PHPUnit_Framework_TestCase;

class MysqlSeriesRepositoryTest extends PHPUnit_Framework_TestCase
{

    protected static $connection;

    public static function setUpBeforeClass()
    {
        $extendedPdo = new ExtendedPdo('sqlite::memory:');
        $extendedPdo->exec("ATTACH DATABASE `jpemeric_blog.db` AS `jpemeric_blog`");

        $extendedPdo->exec("
            CREATE TABLE IF NOT EXISTS `jpemeric_blog`.`post` (
                `id` integer PRIMARY KEY AUTOINCREMENT,
                `title` varchar(60) NOT NULL,
                `path` varchar(60) NOT NULL,
                `category` varchar(15) NOT NULL,
                `date` datetime,
                `body` text,
                `display` integer(1) NOT NULL
            )"
        );
        $extendedPdo->exec("
            CREATE TABLE IF NOT EXISTS `jpemeric_blog`.`series` (
                `id` integer PRIMARY KEY AUTOINCREMENT,
                `title` text NOT NULL,
                `description` text NOT NULL
            )"
        );
        $extendedPdo->exec("
            CREATE TABLE IF NOT EXISTS `jpemeric_blog`.`series_post` (
                `series` integer NOT NULL,
                `post` integer NOT NULL,
                `order` integer(1) NOT NULL
            )"
        );

        self::$connection = new ConnectionLocator(function () use ($extendedPdo) {
            return $extendedPdo;
        });
    }

    public function testIsInstanceOfSeriesRepository()
    {
        $repository = new MysqlSeriesRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Blog\Series\MysqlSeriesRepository',
            $repository
        );
    }

    public function testImplementsSeriesInterface()
    {
        $repository = new MysqlSeriesRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Blog\Series\SeriesRepositoryInterface',
            $repository
        );
    }

    public function testConstructSetsConnections()
    {
        $respository = new MysqlSeriesRepository(self::$connection);

        $this->assertAttributeSame(
            self::$connection,
            'connections',
            $respository
        );
    }

    public function testGetSeriesForPost()
    {
        $testPostData = [
            [
                'id' => rand(1, 100),
                'title' => 'test one',
                'category' => 'test category',
                'path' => 'test-one',
                'display' => 1,
            ],
            [
                'id' => rand(101, 200),
                'title' => 'test two',
                'category' => 'test category',
                'path' => 'test-two',
                'display' => 1,
            ],
        ];

        $testSeriesData = [
            [
                'id' => rand(1, 100),
                'title' => 'test one',
                'description' => 'test description',
            ],
        ];

        $testSeriesPostData = [
            [
                'series' => reset($testSeriesData)['id'],
                'post' => $testPostData[0]['id'],
                'order' => 1,
            ],
            [
                'series' => reset($testSeriesData)['id'],
                'post' => $testPostData[1]['id'],
                'order' => 2,
            ],
        ];

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testSeriesData, [$this, 'insertSeriesData']);
        array_walk($testSeriesPostData, [$this, 'insertSeriesPostData']);

        $repository = new MysqlSeriesRepository(self::$connection);
        $data = $repository->getSeriesForPost(reset($testPostData)['id']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        foreach ($testPostData as $key => $testPostRow) {
            $this->assertInternalType('array', $data[$key]);
            $this->assertArrayHasKey('series_title', $data[$key]);
            $this->assertEquals(reset($testSeriesData)['title'], $data[$key]['series_title']);
            $this->assertArrayHasKey('series_description', $data[$key]);
            $this->assertEquals(reset($testSeriesData)['description'], $data[$key]['series_description']);
            $this->assertArrayHasKey('post', $data[$key]);
            $this->assertEquals($testPostRow['id'], $data[$key]['post']);
            $this->assertArrayHasKey('title', $data[$key]);
            $this->assertEquals($testPostRow['title'], $data[$key]['title']);
            $this->assertArrayHasKey('category', $data[$key]);
            $this->assertEquals($testPostRow['category'], $data[$key]['category']);
            $this->assertArrayHasKey('path', $data[$key]);
            $this->assertEquals($testPostRow['path'], $data[$key]['path']);
        }
    }

    public function testGetSeriesForPostOrder() {}

    public function testGetSeriesForPostSeriesFilter() {}

    public function testGetSeriesForPostInactive() {}

    public function testGetSeriesForPostFailure() {}

    protected function tearDown()
    {
        self::$connection->getDefault()->perform("DELETE FROM `jpemeric_blog`.`series`");
    }

    public static function tearDownAfterClass()
    {
        self::$connection->getDefault()->disconnect();
        unlink('jpemeric_blog.db');
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

    protected function insertSeriesData(array $data)
    {
        $defaultData = [
            'id' => null,
            'title' => '',
            'description' => '',
        ];

        $data = array_merge($defaultData, $data);

        return self::$connection->getDefault()->perform("
            INSERT INTO `jpemeric_blog`.`series`
                (id, title, description)
            VALUES
                (:id, :title, :description)",
            $data
        );
    }

    protected function insertSeriesPostData(array $data)
    {
        $defaultData = [
            'series' => '',
            'post' => '',
            'order' => 0,
        ];

        $data = array_merge($defaultData, $data);

        return self::$connection->getDefault()->perform("
            INSERT INTO `jpemeric_blog`.`series_post`
                (series, post, `order`)
            VALUES
                (:series, :post, :order)",
            $data
        );
    }
}
