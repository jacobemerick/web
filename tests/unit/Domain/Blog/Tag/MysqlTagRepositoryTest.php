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
                `post_id` integer NOT NULL,
                `tag_id` integer NOT NULL
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

        shuffle($testData);

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

    public function testGetAllTags()
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
        $data = $repository->getAllTags();

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertCount(count($testData), $data);
        foreach ($testData as $key => $testDataRow) {
            $this->assertArrayHasKey('id', $data[$key]);
            $this->assertEquals($testDataRow['id'], $data[$key]['id']);
            $this->assertArrayHasKey('tag', $data[$key]);
            $this->assertEquals($testDataRow['tag'], $data[$key]['tag']);
        }
    }
 
    public function testGetAllTagsFailure()
    {
        $repository = new MysqlTagRepository(self::$connection);
        $data = $repository->getAllTags();

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetTagCloud()
    {
        $testPostData = [
            [
                'id' => rand(1, 100),
                'display' => 1,
            ],
            [
                'id' => rand(101, 200),
                'display' => 1,
            ],
        ];

        $testTagData = [
            [
                'id' => rand(1, 100),
                'tag' => 'test one',
            ],
            [
                'id' => rand(101, 200),
                'tag' => 'test two',
            ],
            [
                'id' => rand(201, 300),
                'tag' => 'test three',
            ],
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            $tempTagData = $testTagData;
            shuffle($tempTagData);
            for ($i = 0; $i < 2; $i++) {
                array_push($testPTLinkData, [
                    'post_id' => $testPostRow['id'],
                    'tag_id' => $tempTagData[$i]['id'],
                ]);
            }
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        array_walk($testTagData, [$this, 'insertTagData']);

        $repository = new MysqlTagRepository(self::$connection);
        $data = $repository->getTagCloud();

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        $tagCountData = array_map(function ($row) use ($testTagData) {
            $tag = $row['tag_id'];
            $tag = array_filter($testTagData, function ($row) use ($tag) {
                return ($tag == $row['id']);
            });
            $tag = current($tag)['tag'];
            return $tag;
        }, $testPTLinkData);

        $testCountData = [];
        foreach ($tagCountData as $tagCountRow) {
            $incremented = false;
            foreach ($testCountData as $key => $testCountRow) {
                if ($tagCountRow == $testCountRow['tag']) {
                    $testCountData[$key]['count']++;
                    $incremented = true;
                    break;
                }
            }
            if (!$incremented) {
                array_push($testCountData, [
                    'count' => 1,
                    'tag' => $tagCountRow,
                ]);
            }
        }

        $this->assertCount(count($testCountData), $data);

        usort($testCountData, function ($rowA, $rowB) {
            return ($rowA['tag'] > $rowB['tag']);
        });
        usort($data, function ($rowA, $rowB) {
            return ($rowA['tag'] > $rowB['tag']);
        });

        foreach ($testCountData as $key => $testCountRow) {
            $this->assertArrayHasKey('count', $data[$key]);
            $this->assertEquals($testCountRow['count'], $data[$key]['count']);
            $this->assertArrayHasKey('tag', $data[$key]);
            $this->assertEquals($testCountRow['tag'], $data[$key]['tag']);
        }
    }

    public function testGetTagCloudInactive()
    {
        $testPostData = [
            [
                'id' => rand(1, 100),
                'display' => 1,
            ],
            [
                'id' => rand(101, 200),
                'display' => 1,
            ],
            [
                'id' => rand(201, 300),
                'display' => 0,
            ],
        ];

        $testTagData = [
            [
                'id' => rand(1, 100),
                'tag' => 'test one',
            ],
            [
                'id' => rand(101, 200),
                'tag' => 'test two',
            ],
            [
                'id' => rand(201, 300),
                'tag' => 'test three',
            ],
        ];

        $testPTLinkData = [];
        foreach ($testPostData as $testPostRow) {
            $tempTagData = $testTagData;
            shuffle($tempTagData);
            for ($i = 0; $i < 2; $i++) {
                array_push($testPTLinkData, [
                    'post_id' => $testPostRow['id'],
                    'tag_id' => $tempTagData[$i]['id'],
                ]);
            }
        }

        array_walk($testPostData, [$this, 'insertPostData']);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        array_walk($testTagData, [$this, 'insertTagData']);

        $repository = new MysqlTagRepository(self::$connection);
        $data = $repository->getTagCloud();

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        $testPTLinkData = array_filter($testPTLinkData, function ($row) use ($testPostData) {
            $post = $row['post_id'];
            $post = array_filter($testPostData, function ($row) use ($post) {
                return ($post == $row['id']);
            });
            $post = current($post);
            return ($post['display'] == 1);
        });

        $tagCountData = array_map(function ($row) use ($testTagData) {
            $tag = $row['tag_id'];
            $tag = array_filter($testTagData, function ($row) use ($tag) {
                return ($tag == $row['id']);
            });
            $tag = current($tag)['tag'];
            return $tag;
        }, $testPTLinkData);

        $testCountData = [];
        foreach ($tagCountData as $tagCountRow) {
            $incremented = false;
            foreach ($testCountData as $key => $testCountRow) {
                if ($tagCountRow == $testCountRow['tag']) {
                    $testCountData[$key]['count']++;
                    $incremented = true;
                    break;
                }
            }
            if (!$incremented) {
                array_push($testCountData, [
                    'count' => 1,
                    'tag' => $tagCountRow,
                ]);
            }
        }

        $this->assertCount(count($testCountData), $data);

        usort($testCountData, function ($rowA, $rowB) {
            return ($rowA['tag'] > $rowB['tag']);
        });
        usort($data, function ($rowA, $rowB) {
            return ($rowA['tag'] > $rowB['tag']);
        });

        foreach ($testCountData as $key => $testCountRow) {
            $this->assertArrayHasKey('count', $data[$key]);
            $this->assertEquals($testCountRow['count'], $data[$key]['count']);
            $this->assertArrayHasKey('tag', $data[$key]);
            $this->assertEquals($testCountRow['tag'], $data[$key]['tag']);
        }
    }

    public function testGetTagCloudFailure()
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
        $data = $repository->getTagCloud();

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }
 
    public function testGetTagsForPost()
    {
        $testPostData = [
            'id' => rand(1, 100),
            'display' => 1,
        ];

        $testTagData = [
            [
                'id' => rand(1, 100),
                'tag' => 'test one',
            ],
            [
                'id' => rand(101, 200),
                'tag' => 'test two',
            ],
            [
                'id' => rand(201, 300),
                'tag' => 'test three',
            ],
        ];

        $testPTLinkData = [];
        foreach ($testTagData as $testTagRow) {
            array_push($testPTLinkData, [
                'post_id' => $testPostData['id'],
                'tag_id' => $testTagRow['id'],
            ]);
        }

        $this->insertPostData($testPostData);
        array_walk($testPTLinkData, [$this, 'insertPTLinkData']);
        array_walk($testTagData, [$this, 'insertTagData']);

        $repository = new MysqlTagRepository(self::$connection);
        $data = $repository->getTagsForPost($testPostData['id']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertCount(count($testTagData), $data);

        usort($testTagData, function ($rowA, $rowB) {
            return ($rowA['tag'] > $rowB['tag']);
        });

        foreach ($testTagData as $key => $testTagRow) {
            $this->assertArrayHasKey('id', $data[$key]);
            $this->assertEquals($testTagRow['id'], $data[$key]['id']);
            $this->assertArrayHasKey('tag', $data[$key]);
            $this->assertEquals($testTagRow['tag'], $data[$key]['tag']);
        }
    }
 
    public function testGetTagsForPostFailure()
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
        $data = $repository->getTagsForPost(rand(1, 10));

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
