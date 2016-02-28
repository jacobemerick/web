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
                `category` varchar(15) NOT NULL,
                `date` datetime,
                `body` text,
                `display` integer(1) NOT NULL
            )"
        );
        $extendedPdo->exec("
            CREATE TABLE IF NOT EXISTS `jpemeric_blog`.`ptlink` (
                `post_id` integer NOT NULL,
                `tag_id` integer NOT NULL
            )"
        );
        $extendedPdo->exec("
            CREATE TABLE IF NOT EXISTS `jpemeric_blog`.`series_post` (
                `series` integer NOT NULL,
                `post` integer NOT NULL,
                `order` integer(1) NOT NULL
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
            'display'  => 0
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
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 0,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 1,
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

    public function testGetActivePostsRange()
    {
        $testData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 1,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 1,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePosts(2, 1);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertCount(2, $data);

        $testData = array_slice($testData, 2, 1);

        $testIds = array_column($testData, 'ids');
        $dataIds = array_column($data, 'ids');

        $this->assertEmpty(array_merge(
            array_diff($testIds, $dataIds),
            array_diff($dataIds, $testIds)
        ));
    }

    public function testGetActivePostsRangeFailure()
    {
        $testData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 1,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 1,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePosts(1, 3);

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetActivePostsCount()
    {
        $testData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 1,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsCount();

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);
        $this->assertEquals(count($testData), $data);
    }

    public function testGetActivePostsCountInactive()
    {
        $testData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 1,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 0,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsCount();

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);

        $testData = array_filter($testData, function ($row) {
            return ($row['display'] == 1);
        });

        $this->assertEquals(count($testData), $data);
    }

    public function testGetActivePostsCountFailure()
    {
        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsCount();

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);
        $this->assertEquals('0', $data);
    }

    public function testGetActivePostsByTag()
    {
        $testPostData = [
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

        $testTagData = [
            'id' => rand(1, 100),
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostRow['id'],
                'tag_id' => $testTagData['id'],
            ]);
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByTag($testTagData['id']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertCount(count($testPostData), $data);
        foreach ($testPostData as $key => $testPostRow) {
            $this->assertArrayHasKey('id', $data[$key]);
            $this->assertEquals($testPostRow['id'], $data[$key]['id']);
            $this->assertArrayHasKey('title', $data[$key]);
            $this->assertEquals($testPostRow['title'], $data[$key]['title']);
            $this->assertArrayHasKey('path', $data[$key]);
            $this->assertEquals($testPostRow['path'], $data[$key]['path']);
            $this->assertArrayHasKey('date', $data[$key]);
            $this->assertEquals($testPostRow['date'], $data[$key]['date']);
            $this->assertArrayHasKey('body', $data[$key]);
            $this->assertEquals($testPostRow['body'], $data[$key]['body']);
            $this->assertArrayHasKey('category', $data[$key]);
            $this->assertEquals($testPostRow['category'], $data[$key]['category']);
        }
    }

    public function testGetActivePostsByTagInactive()
    {
        $testPostData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 0,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 1,
            ],
        ];

        $testTagData = [
            'id' => rand(1, 100),
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostRow['id'],
                'tag_id' => $testTagData['id'],
            ]);
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByTag($testTagData['id']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        $testPostData = array_filter($testPostData, function ($row) {
            return ($row['display'] == 1);
        });

        $this->assertCount(count($testPostData), $data);

        $testIds = array_column($testPostData, 'ids');
        $dataIds = array_column($data, 'ids');

        $this->assertEmpty(array_merge(
            array_diff($testIds, $dataIds),
            array_diff($dataIds, $testIds)
        ));
    }
 
    public function testGetActivePostsByTagFailure()
    {
        $testTagData = [
            'id' => rand(1, 100),
        ];

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByTag($testTagData['id']);

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetActivePostsByTagRange()
    {
        $testPostData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 1,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 1,
            ],
        ];

        $testTagData = [
            'id' => rand(1, 100),
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostRow['id'],
                'tag_id' => $testTagData['id'],
            ]);
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByTag($testTagData['id'], 2, 1);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        $testPostData = array_slice($testPostData, 1, 2);

        $this->assertCount(count($testPostData), $data);

        $testIds = array_column($testPostData, 'ids');
        $dataIds = array_column($data, 'ids');

        $this->assertEmpty(array_merge(
            array_diff($testIds, $dataIds),
            array_diff($dataIds, $testIds)
        ));
    }

    public function testGetActivePostsByTagRangeFailure()
    {
        $testPostData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 1,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 1,
            ],
        ];

        $testTagData = [
            'id' => rand(1, 100),
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostRow['id'],
                'tag_id' => $testTagData['id'],
            ]);
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByTag($testTagData['id'], 1, 3);

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetActivePostsCountByTag()
    {
        $testPostData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 1,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 1,
            ],
        ];

        $testTagData = [
            'id' => rand(1, 100),
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostRow['id'],
                'tag_id' => $testTagData['id'],
            ]);
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsCountByTag($testTagData['id']);

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);
        $this->assertEquals(count($testPostData), $data);
    }

    public function testGetActivePostsCountByTagInactive()
    {
        $testPostData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 0,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 1,
            ],
        ];

        $testTagData = [
            'id' => rand(1, 100),
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostRow['id'],
                'tag_id' => $testTagData['id'],
            ]);
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsCountByTag($testTagData['id']);

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);

        $testPostData = array_filter($testPostData, function ($row) {
            return ($row['display'] == 1);
        });

        $this->assertEquals(count($testPostData), $data);
    }
 
    public function testGetActivePostsCountByTagFailure()
    {
        $testTagData = [
            'id' => rand(1, 100),
        ];

        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsCountByTag($testTagData['id']);

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);
        $this->assertEquals('0', $data);
    }
 
    public function testGetActivePostsByCategory()
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
        $data = $repository->getActivePostsByCategory(reset($testData)['category']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertCount(count($testData), $data);
        foreach ($testData as $key => $testDataRow) {
            $this->assertArrayHasKey('id', $data[$key]);
            $this->assertEquals($testDataRow['id'], $data[$key]['id']);
            $this->assertArrayHasKey('title', $data[$key]);
            $this->assertEquals($testDataRow['title'], $data[$key]['title']);
            $this->assertArrayHasKey('path', $data[$key]);
            $this->assertEquals($testDataRow['path'], $data[$key]['path']);
            $this->assertArrayHasKey('date', $data[$key]);
            $this->assertEquals($testDataRow['date'], $data[$key]['date']);
            $this->assertArrayHasKey('body', $data[$key]);
            $this->assertEquals($testDataRow['body'], $data[$key]['body']);
            $this->assertArrayHasKey('category', $data[$key]);
            $this->assertEquals($testDataRow['category'], $data[$key]['category']);
        }
    }

    public function testGetActivePostsByCategoryInactive()
    {
        $testData = [
            [
                'id'       => rand(1, 100),
                'category' => 'test category',
                'display'  => 1,
            ],
            [
                'id'       => rand(101, 200),
                'category' => 'test category',
                'display'  => 1,
            ],
            [
                'id'       => rand(201, 300),
                'category' => 'test category',
                'display'  => 0,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByCategory(reset($testData)['category']);

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
 
    public function testGetActivePostsByCategoryFailure()
    {
        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByCategory('');

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetActivePostsByCategoryRange()
    {
        $testData = [
            [
                'id'       => rand(1, 100),
                'category' => 'test category',
                'display'  => 1,
            ],
            [
                'id'       => rand(101, 200),
                'category' => 'test category',
                'display'  => 1,
            ],
            [
                'id'       => rand(201, 300),
                'category' => 'test category',
                'display'  => 1,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByCategory(reset($testData)['category'], 2, 1);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        $testData = array_slice($testData, 1, 2);

        $this->assertCount(count($testData), $data);

        $testIds = array_column($testData, 'ids');
        $dataIds = array_column($data, 'ids');

        $this->assertEmpty(array_merge(
            array_diff($testIds, $dataIds),
            array_diff($dataIds, $testIds)
        ));
    }

    public function testGetActivePostsByCategoryRangeFailure()
    {
        $testData = [
            [
                'id'       => rand(1, 100),
                'category' => 'test category',
                'display'  => 1,
            ],
            [
                'id'       => rand(101, 200),
                'category' => 'test category',
                'display'  => 1,
            ],
            [
                'id'       => rand(201, 300),
                'category' => 'test category',
                'display'  => 1,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByCategory(reset($testData)['category'], 1, 3);

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetActivePostsCountByCategory()
    {
        $testData = [
            [
                'id'       => rand(1, 100),
                'category' => 'test category',
                'display'  => 1,
            ],
            [
                'id'       => rand(101, 200),
                'category' => 'test category',
                'display'  => 1,
            ],
            [
                'id'       => rand(201, 300),
                'category' => 'test category',
                'display'  => 1,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsCountByCategory(reset($testData)['category']);

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);
        $this->assertEquals(count($testData), $data);
    }

    public function testGetActivePostsCountByCategoryInactive()
    {
        $testData = [
            [
                'id'       => rand(1, 100),
                'category' => 'test category',
                'display'  => 0,
            ],
            [
                'id'       => rand(101, 200),
                'category' => 'test category',
                'display'  => 1,
            ],
            [
                'id'       => rand(201, 300),
                'category' => 'test category',
                'display'  => 1,
            ],
        ];

        array_walk($testData, [$this, 'insertPostData']);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsCountByCategory(reset($testData)['category']);

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);

        $testData = array_filter($testData, function ($row) {
            return ($row['display'] == 1);
        });

        $this->assertEquals(count($testData), $data);
    }

    public function testGetActivePostsCountByCategoryFailure()
    {
        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsCountByCategory('');

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);
        $this->assertEquals('0', $data);
    }

    public function testGetActivePostsByRelatedTags()
    {
        $testPostData = [
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
                'date'     => (new DateTime('-2 days'))->format('Y-m-d H:i:s'),
                'body'     => 'body two',
                'display'  => 1,
            ],
            [
                'id'       => rand(201, 300),
                'title'    => 'title three',
                'path'     => 'path-three',
                'category' => 'test category',
                'date'     => (new DateTime('-3 days'))->format('Y-m-d H:i:s'),
                'body'     => 'body three',
                'display'  => 1,
            ],
        ];

        $testTagData = [
            'id' => rand(1, 100),
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostRow['id'],
                'tag_id' => $testTagData['id'],
            ]);
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByRelatedTags(reset($testPostData)['id']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        array_shift($testPostData);

        $this->assertCount(count($testPostData), $data);
        foreach ($testPostData as $key => $testPostRow) {
            $this->assertArrayHasKey('id', $data[$key]);
            $this->assertEquals($testPostRow['id'], $data[$key]['id']);
            $this->assertArrayHasKey('title', $data[$key]);
            $this->assertEquals($testPostRow['title'], $data[$key]['title']);
            $this->assertArrayHasKey('path', $data[$key]);
            $this->assertEquals($testPostRow['path'], $data[$key]['path']);
            $this->assertArrayHasKey('date', $data[$key]);
            $this->assertEquals($testPostRow['date'], $data[$key]['date']);
            $this->assertArrayHasKey('body', $data[$key]);
            $this->assertEquals($testPostRow['body'], $data[$key]['body']);
            $this->assertArrayHasKey('category', $data[$key]);
            $this->assertEquals($testPostRow['category'], $data[$key]['category']);
            $this->assertArrayHasKey('count', $data[$key]);
            $this->assertEquals(count($testTagData), $data[$key]['count']);
        }
    }

    public function testGetActivePostsByRelatedTagsLimit()
    {
        $testPostData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 1,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 1,
            ],
        ];

        $testTagData = [
            'id' => rand(1, 100),
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostRow['id'],
                'tag_id' => $testTagData['id'],
            ]);
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByRelatedTags(reset($testPostData)['id'], 1);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        $testPostData = array_slice($testPostData, 1, 1);

        $this->assertCount(count($testPostData), $data);

        $testIds = array_column($testPostData, 'ids');
        $dataIds = array_column($data, 'ids');

        $this->assertEmpty(array_merge(
            array_diff($testIds, $dataIds),
            array_diff($dataIds, $testIds)
        ));
    }
 
    public function testGetActivePostsByRelatedTagsInactive()
    {
        $testPostData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 1,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 0,
            ],
            [
                'id'      => rand(301, 400),
                'display' => 1,
            ],
        ];

        $testTagData = [
            'id' => rand(1, 100),
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostRow['id'],
                'tag_id' => $testTagData['id'],
            ]);
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByRelatedTags(reset($testPostData)['id']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        array_shift($testPostData);
        $testPostData = array_filter($testPostData, function ($row) {
            return ($row['display'] == 1);
        });

        $this->assertCount(count($testPostData), $data);

        $testIds = array_column($testPostData, 'ids');
        $dataIds = array_column($data, 'ids');

        $this->assertEmpty(array_merge(
            array_diff($testIds, $dataIds),
            array_diff($dataIds, $testIds)
        ));
    }
 
    public function testGetActivePostsByRelatedTagsExcludeSeries()
    {
        $testPostData = [
            [
                'id'      => rand(1, 100),
                'display' => 1,
            ],
            [
                'id'      => rand(101, 200),
                'display' => 1,
            ],
            [
                'id'      => rand(201, 300),
                'display' => 1,
            ],
            [
                'id'      => rand(301, 400),
                'display' => 1,
            ],
        ];

        $testTagData = [
            'id' => rand(1, 100),
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostRow['id'],
                'tag_id' => $testTagData['id'],
            ]);
        }

        $seriesPostKey = rand(1, 3);
        $testSeriesPostData = [
            [
                'series' => 1,
                'post' => reset($testPostData)['id'],
            ],
            [
                'series' => 1,
                'post' => $testPostData[$seriesPostKey]['id'],
            ],
        ];

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        array_walk($testSeriesPostData, [$this, 'insertSeriesPostData']);
        $this->insertTagData($testTagData);

        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByRelatedTags(reset($testPostData)['id']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        array_shift($testPostData);
        $testPostData = array_filter($testPostData, function ($row) use ($testSeriesPostData) {
            return (!in_array($row['id'], array_column($testSeriesPostData, 'post')));
        });

        $this->assertCount(count($testPostData), $data);

        $testIds = array_column($testPostData, 'ids');
        $dataIds = array_column($data, 'ids');

        $this->assertEmpty(array_merge(
            array_diff($testIds, $dataIds),
            array_diff($dataIds, $testIds)
        ));
    }

    public function testGetActivePostsByRelatedTagsFailure()
    {
        $repository = new MysqlPostRepository(self::$connection);
        $data = $repository->getActivePostsByRelatedTags('');

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
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

    protected function insertPTLinkData(array $data)
    {
        $defaultData = [
            'post' => null,
            'tag' => null,
        ];

        $data = array_merge($defaultData, $data);

        return self::$connection->getDefault()->perform("
            INSERT INTO `jpemeric_blog`.`ptlink`
                (post_id, tag_id)
            VALUES
                (:post_id, :tag_id)",
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
        self::$connection->getDefault()->perform("DELETE FROM `jpemeric_blog`.`series_post`");
        self::$connection->getDefault()->perform("DELETE FROM `jpemeric_blog`.`tag`");
    }

    public static function tearDownAfterClass()
    {
        self::$connection->getDefault()->disconnect();
        unlink('jpemeric_blog.db');
    }
}
