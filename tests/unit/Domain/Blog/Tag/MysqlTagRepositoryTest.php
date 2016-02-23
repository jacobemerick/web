<?php

namespace Jacobemerick\Web\Domain\Blog\Tag;

use Aura\Sql\ConnectionLocator;
use Aura\Sql\ExtendedPdo;
use PHPUnit_Framework_TestCase;

class MysqlTagRepositoryTest extends PHPUnit_Framework_TestCase
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
            CREATE TABLE IF NOT EXISTS `jpemeric_blog`.`ptlink` (
                `post` integer NOT NULL,
                `tag` integer NOT NULL
            )"
        );
        $extendedPdo->exec("
            CREATE TABLE IF NOT EXISTS `jpemeric_blog`.`tag` (
                `id` integer PRIMARY KEY AUTOINCREMENT,
                `tag` varchar(25) NOT NULL
            )"
        );

        self::$connection = new ConnectionLocator(function () use ($extendedPdo) {
            return $extendedPdo;
        });
    }

    public function testIsInstanceOfTagRepository()
    {
        $repository = new MysqlTagRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Blog\Tag\MysqlTagRepository',
            $repository
        );
    }

    public function testImplementsTagInterface()
    {
        $repository = new MysqlTagRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Blog\Tag\TagRepositoryInterface',
            $repository
        );
    }

    public function testConstructSetsConnections()
    {
        $respository = new MysqlTagRepository(self::$connection);

        $this->assertAttributeSame(
            self::$connection,
            'connections',
            $respository
        );
    }

    public function testFindTagByTitle()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'tag' => 'test one',
            ],
            [
                'id' => rand(101, 200),
                'tag' => 'test two',
            ],
        ];

        array_walk($testData, [$this, 'insertTagData']);

        $repository = new MysqlTagRepository(self::$connection);
        $data = $repository->findTagByTitle(reset($testData)['tag']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('id', $data);
        $this->assertEquals(reset($testData)['id'], $data['id']);
        $this->assertArrayHasKey('tag', $data);
        $this->assertEquals(reset($testData)['tag'], $data['tag']);
    }

    public function testFindTagByTitleFailure()
    {
        $repository = new MysqlTagRepository(self::$connection);
        $data = $repository->findTagByTitle('empty tag');

        $this->assertFalse($data);
    }

    public function testGetAllTags() {}

    public function testGetAllTagsFailure() {}

    public function testGetTagCloud() {}

    public function testGetTagCloudInactive() {}

    public function testGetTagCloudFailure() {}

    public function testGetTagsForPost() {}

    public function testGetTagsForPostOrder() {}

    public function testGetTagsForPostFailure() {}

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

    protected function insertPTLinkData(array $data)
    {
        $defaultData = [
            'post' => null,
            'tag' => null,
        ];

        $data = array_merge($defaultData, $data);

        return self::$connection->getDefault()->perform("
            INSERT INTO `jpemeric_blog`.`ptlink`
                (post, tag)
            VALUES
                (:post, :tag)",
            $data
        );
    }

    protected function insertTagData(array $data)
    {
        $defaultData = [
            'id' => null,
            'tag' => '',
        ];

        $data = array_merge($defaultData, $data);

        return self::$connection->getDefault()->perform("
            INSERT INTO `jpemeric_blog`.`tag`
                (id, tag)
            VALUES
                (:id, :tag)",
            $data
        );
    }

    protected function tearDown()
    {
        self::$connection->getDefault()->perform("DELETE FROM `jpemeric_blog`.`post`");
        self::$connection->getDefault()->perform("DELETE FROM `jpemeric_blog`.`ptlink`");
        self::$connection->getDefault()->perform("DELETE FROM `jpemeric_blog`.`tag`");
    }

    public static function tearDownAfterClass()
    {
        self::$connection->getDefault()->disconnect();
        unlink('jpemeric_blog.db');
    }
}
