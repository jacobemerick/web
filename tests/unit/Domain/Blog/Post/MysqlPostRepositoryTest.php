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

    public function testGetActivePosts()
    {
        $testData = [
            [
                'id'       => rand(1, 100),
                'title'    => 'title one',
                'path'     => 'path-one',
                'category' => 'test category',
                'date'     => (new DateTime('-1 day'))->format('Y-m-d H:i:s'),
                'body'     => 'body one',
                'display'  => 1,
            ],
            [
                'id'       => rand(101, 200),
                'title'    => 'title two',
                'path'     => 'path-two',
                'category' => 'test category',
                'date'     => (new DateTime())->format('Y-m-d H:i:s'),
                'body'     => 'body one',
                'display'  => 1,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePosts();

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertCount(count($testData), $data);

        usort($testData, function ($rowA, $rowB) {
            return ((new DateTime($rowA['date'])) < (new DateTime($rowB['date'])));
        });

        foreach ($testData as $key => $testRow) {
            $this->assertArrayHasKey('id', $data[$key]);
            $this->assertEquals($testRow['id'], $data[$key]['id']);
            $this->assertArrayHasKey('title', $data[$key]);
            $this->assertEquals($testRow['title'], $data[$key]['title']);
            $this->assertArrayHasKey('path', $data[$key]);
            $this->assertEquals($testRow['path'], $data[$key]['path']);
            $this->assertArrayHasKey('date', $data[$key]);
            $this->assertEquals($testRow['date'], $data[$key]['date']);
            $this->assertArrayHasKey('body', $data[$key]);
            $this->assertEquals($testRow['body'], $data[$key]['body']);
            $this->assertArrayHasKey('category', $data[$key]);
            $this->assertEquals($testRow['category'], $data[$key]['category']);
        }
    }
 
    public function testGetActivePostsInactive()
    {
        $testData = [
            [
                'id'       => rand(1, 100),
                'display'  => 1,
            ],
            [
                'id'       => rand(101, 200),
                'display'  => 0,
            ],
            [
                'id'       => rand(201, 300),
                'display'  => 1,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePosts();

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        $testData = array_filter($testData, function ($row) {
            return ($row['display'] == 1);
        });

        $this->assertCount(count($testData), $data);

        $testIds = array_column($testData, 'ids');
        $dataIds = array_column($data, 'ids');

        $this->assertEmpty(array_merge(
            array_diff($testIds, $dataIds),
            array_diff($dataIds, $testIds)
        ));
    }
 
    public function testGetActivePostsFailure()
    {
        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePosts();

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetActivePostsRange() {}

    public function testGetActivePostsRangeFailure() {}

    public function testGetActivePostsCount() {}

    public function testGetActivePostsCountInactive() {}

    public function testGetActivePostsCountFailure() {}

    public function testGetActivePostsByTag() {}

    public function testGetActivePostsByTagInactive() {}

    public function testGetActivePostsByTagFailure() {}

    public function testGetActivePostsByTagRange() {}

    public function testGetActivePostsByTagRangeFailure() {}

    public function testGetActivePostsCountByTag() {}

    public function testGetActivePostsCountByTagInactive() {}

    public function testGetActivePostsCountByTagFailure() {}

    public function testGetActivePostsByCategory() {}

    public function testGetActivePostsByCategoryInactive() {}

    public function testGetActivePostsByCategoryFailure() {}

    public function testGetActivePostsByCategoryRange() {}

    public function testGetActivePostsByCategoryRangeFailure() {}

    public function testGetActivePostsCountByCategory() {}

    public function testGetActivePostsCountByCategoryInactive() {}

    public function testGetActivePostsCountByCategoryFailure() {}

    public function testGetActivePostsByRelatedTags() {}

    public function testGetActivePostsByRelatedTagsLimit() {}

    public function testGetActivePostsByRelatedTagsInactive() {}

    public function testGetActivePostsByRelatedTagsExcludeSeries() {}

    public function testGetActivePostsByRelatedTagsFailure() {}

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
