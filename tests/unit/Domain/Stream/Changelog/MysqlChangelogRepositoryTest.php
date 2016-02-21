<?php

namespace Jacobemerick\Web\Domain\Stream\Changelog;

use Aura\Sql\ConnectionLocator;
use Aura\Sql\ExtendedPdo;
use PHPUnit_Framework_TestCase;

class MysqlChangelogRepositoryTest extends PHPUnit_Framework_TestCase
{

    protected static $connection;

    public static function setUpBeforeClass()
    {
        $extendedPdo = new ExtendedPdo('sqlite::memory:');
        $extendedPdo->exec("ATTACH DATABASE `jpemeric_stream.db` AS `jpemeric_stream`");
        $extendedPdo->exec("
            CREATE TABLE IF NOT EXISTS `jpemeric_stream`.`changelog` (
              `id` integer PRIMARY KEY AUTOINCREMENT,
              `hash` char(40) NOT NULL,
              `message` text,
              `message_short` varchar(100),
              `datetime` datetime NOT NULL,
              `author` varchar(50) NOT NULL,
              `commit_link` varchar(100) NOT NULL,
              `created_at` datetime,
              `updated_at` datetime
            )"
        );

        self::$connection = new ConnectionLocator(function () use ($extendedPdo) {
            return $extendedPdo;
        });
    }

    public function testIsInstanceOfChangelogRepository()
    {
        $repository = new MysqlChangelogRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Stream\Changelog\MysqlChangelogRepository',
            $repository
        );
    }

    public function testImplementsChangelogInterface()
    {
        $repository = new MysqlChangelogRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Stream\Changelog\ChangelogRepositoryInterface',
            $repository
        );
    }

    public function testConstructSetsConnections()
    {
        $respository = new MysqlChangelogRepository(self::$connection);

        $this->assertAttributeSame(
            self::$connection,
            'connections',
            $respository
        );
    }

    public function testGetChanges()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'message' => 'test one',
            ],
            [
                'id' => rand(101, 200),
                'message' => 'test two',
            ],
        ];

        array_walk($testData, [$this, 'insertData']);

        $repository = new MysqlChangelogRepository(self::$connection);
        $data = $repository->getChanges();

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        foreach ($testData as $key => $testRow) {
            $this->assertInternalType('array', $testRow);
            $this->assertArraySubset($testRow, $data[$key]);
        }
    }

    public function testGetChangesFailure()
    {
        $repository = new MysqlChangelogRepository(self::$connection);
        $data = $repository->getChanges();

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetChangesRange()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'message' => 'test one',
            ],
            [
                'id' => rand(101, 200),
                'message' => 'test two',
            ],
            [
                'id' => rand(201, 300),
                'message' => 'test three',
            ],
        ];

        array_walk($testData, [$this, 'insertData']);

        $repository = new MysqlChangelogRepository(self::$connection);
        $data = $repository->getChanges(2, 1);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertCount(2, $data);

        $testData = array_slice($testData, 1, 2);

        foreach ($testData as $key => $testRow) {
            $this->assertInternalType('array', $testRow);
            $this->assertArraySubset($testRow, $data[$key]);
        }
    }

    public function testGetChangesRangeFailure()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'message' => 'test one',
            ],
            [
                'id' => rand(101, 200),
                'message' => 'test two',
            ],
        ];

        array_walk($testData, [$this, 'insertData']);

        $repository = new MysqlChangelogRepository(self::$connection);
        $data = $repository->getChanges(1, 3);

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    protected function tearDown()
    {
        self::$connection->getDefault()->perform("DELETE FROM `jpemeric_stream`.`changelog`");
    }

    public static function tearDownAfterClass()
    {
        self::$connection->getDefault()->disconnect();
        unlink('jpemeric_stream.db');
    }

    protected function insertData(array $data)
    {
        $defaultData = [
            'id' => null,
            'hash' => '',
            'message' => null,
            'message_short' => null,
            'datetime' => '',
            'author' => '',
            'commit_link' => '',
        ];

        $data = array_merge($defaultData, $data);

        return self::$connection->getDefault()->perform("
            INSERT INTO `jpemeric_stream`.`changelog`
                (id, hash, message, message_short, datetime, author, commit_link)
            VALUES
                (:id, :hash, :message, :message_short, :datetime, :author, :commit_link)",
            $data
        );
    }
}
