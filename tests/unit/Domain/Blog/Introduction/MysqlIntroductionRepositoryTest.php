<?php

namespace Jacobemerick\Web\Domain\Blog\Introduction;

use Aura\Sql\ConnectionLocator;
use Aura\Sql\ExtendedPdo;
use PHPUnit_Framework_TestCase;

class MysqlIntroductionRepositoryTest extends PHPUnit_Framework_TestCase
{

    protected static $connection;

    public static function setUpBeforeClass()
    {
        $extendedPdo = new ExtendedPdo('sqlite::memory:');
        $extendedPdo->exec("ATTACH DATABASE `jpemeric_blog.db` AS `jpemeric_blog`");

        $extendedPdo->exec("
            CREATE TABLE IF NOT EXISTS `jpemeric_blog`.`introduction` (
                `id` integer PRIMARY KEY AUTOINCREMENT,
                `type` varchar(10) NOT NULL,
                `value` varchar(25) NOT NULL,
                `title` varchar(100) NOT NULL,
                `content` text NOT NULL,
                `image` image
            )"
        );

        self::$connection = new ConnectionLocator(function () use ($extendedPdo) {
            return $extendedPdo;
        });
    }

    public function testIsInstanceOfIntroductionRepository()
    {
        $repository = new MysqlIntroductionRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Blog\Introduction\MysqlIntroductionRepository',
            $repository
        );
    }

    public function testImplementsIntroductionInterface()
    {
        $repository = new MysqlIntroductionRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Blog\Introduction\IntroductionRepositoryInterface',
            $repository
        );
    }

    public function testConstructSetsConnections()
    {
        $respository = new MysqlIntroductionRepository(self::$connection);

        $this->assertAttributeSame(
            self::$connection,
            'connections',
            $respository
        );
    }

    public function testFindByType()
    {
        $testData = [
            'id' => rand(1, 100),
            'type' => 'test',
            'title' => 'test title',
            'content' => 'test content',
            'image' => rand(1, 100),
        ];

        $this->insertData($testData);

        $repository = new MysqlIntroductionRepository(self::$connection);
        $data = $repository->findByType('test');

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('title', $data);
        $this->assertEquals($testData['title'], $data['title']);
        $this->assertArrayHasKey('content', $data);
        $this->assertEquals($testData['content'], $data['content']);
        $this->assertArrayHasKey('image', $data);
        $this->assertEquals($testData['image'], $data['image']);
    }

    public function testFindByTypeFilterValue()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'type' => 'test',
                'title' => 'title a',
                'value' => 'value a',
            ],
            [
                'id' => rand(101, 200),
                'type' => 'test',
                'title' => 'title b',
                'value' => 'value b',
            ],
        ];

        array_walk($testData, [$this, 'insertData']);

        $repository = new MysqlIntroductionRepository(self::$connection);
        $data = $repository->findByType('test', reset($testData)['value']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertEquals(reset($testData)['title'], $data['title']);
    }
 
    public function testFindByTypeFailure()
    {
        $repository = new MysqlIntroductionRepository(self::$connection);
        $data = $repository->findByType('empty type');

        $this->assertFalse($data);
    }

    protected function tearDown()
    {
        self::$connection->getDefault()->perform("DELETE FROM `jpemeric_blog`.`introduction`");
    }

    public static function tearDownAfterClass()
    {
        self::$connection->getDefault()->disconnect();
        unlink('jpemeric_blog.db');
    }

    protected function insertData(array $data)
    {
        $defaultData = [
            'id' => null,
            'type' => '',
            'value' => '',
            'title' => '',
            'content' => '',
            'image' => null,
        ];

        $data = array_merge($defaultData, $data);

        return self::$connection->getDefault()->perform("
            INSERT INTO `jpemeric_blog`.`introduction`
                (id, type, value, title, content, image)
            VALUES
                (:id, :type, :value, :title, :content, :image)",
            $data
        );
    }
}
