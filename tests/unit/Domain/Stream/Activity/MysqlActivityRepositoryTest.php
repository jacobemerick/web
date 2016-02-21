<?php

namespace Jacobemerick\Web\Domain\Stream\Activity;

use Aura\Sql\ConnectionLocator;
use Aura\Sql\ExtendedPdo;
use PHPUnit_Framework_TestCase;

class MysqlActivityRepositoryTest extends PHPUnit_Framework_TestCase
{

    protected static $connection;

    public static function setUpBeforeClass()
    {
        $extendedPdo = new ExtendedPdo('sqlite::memory:');
        $extendedPdo->exec("ATTACH DATABASE `jpemeric_stream.db` AS `jpemeric_stream`");
        $extendedPdo->exec("
            CREATE TABLE IF NOT EXISTS `jpemeric_stream`.`activity` (
              `id` integer PRIMARY KEY AUTOINCREMENT,
              `message` text NOT NULL,
              `message_long` text NOT NULL,
              `datetime` datetime NOT NULL,
              `metadata` text NOT NULL,
              `type` varchar(10) NOT NULL,
              `type_id` integer NOT NULL,
              `created_at` datetime,
              `updated_at` datetime
            )"
        );

        self::$connection = new ConnectionLocator(function () use ($extendedPdo) {
            return $extendedPdo;
        });
    }

    public function testIsInstanceOfActivityRepository()
    {
        $repository = new MysqlActivityRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Stream\Activity\MysqlActivityRepository',
            $repository
        );
    }

    public function testImplementsActivityInterface()
    {
        $repository = new MysqlActivityRepository(self::$connection);

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Stream\Activity\ActivityRepositoryInterface',
            $repository
        );
    }

    public function testConstructSetsConnections()
    {
        $respository = new MysqlActivityRepository(self::$connection);

        $this->assertAttributeSame(
            self::$connection,
            'connections',
            $respository
        );
    }

    public function testGetActivityById()
    {
        $testData = [
            'id' => rand(1, 100),
            'message' => 'test data',
        ];

        $this->insertData($testData);

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivityById($testData['id']);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertArraySubset($testData, $data);
    }

    public function testGetActivityByIdFailure()
    {
        $testData = [
            'id' => rand(1, 100),
            'message' => 'test data',
        ];

        $this->insertData($testData);

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivityById($testData['id'] + 1);

        $this->assertFalse($data);
    }

    public function testGetActivities()
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

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivities();

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        foreach ($testData as $key => $testRow) {
            $this->assertInternalType('array', $testRow);
            $this->assertArraySubset($testRow, $data[$key]);
        }
    }

    public function testGetActivitiesFailure()
    {
        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivities();

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetActivitiesRange()
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

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivities(2, 1);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertCount(2, $data);

        $testData = array_slice($testData, 1, 2);

        foreach ($testData as $key => $testRow) {
            $this->assertInternalType('array', $testRow);
            $this->assertArraySubset($testRow, $data[$key]);
        }
    }

    public function testGetActivitiesRangeFailure()
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

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivities(1, 3);

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetActivitiesCount()
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

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivitiesCount();

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);
        $this->assertEquals(count($testData), $data);
    }

    public function testGetActivitiesCountEmpty()
    {
        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivitiesCount();

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);
        $this->assertEquals('0', $data);
    }

    public function testGetActivitiesByType()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'message' => 'test one',
                'type' => 'type one',
            ],
            [
                'id' => rand(101, 200),
                'message' => 'test two',
                'type' => 'type two',
            ],
            [
                'id' => rand(201, 300),
                'message' => 'test three',
                'type' => 'type one',
            ],
        ];

        array_walk($testData, [$this, 'insertData']);

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivitiesByType('type one');

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);

        $testData = array_filter($testData, function ($row) {
            return ($row['type'] == 'type one');
        });
        $testData = array_values($testData);

        foreach ($testData as $key => $testRow) {
            $this->assertInternalType('array', $testRow);
            $this->assertArraySubset($testRow, $data[$key]);
        }
    }

    public function testGetActivitiesByTypeFailure()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'message' => 'test one',
                'type' => 'type one',
            ],
            [
                'id' => rand(101, 200),
                'message' => 'test two',
                'type' => 'type one',
            ],
        ];

        array_walk($testData, [$this, 'insertData']);

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivitiesByType('type two');

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetActivitiesByTypeRange()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'message' => 'test one',
                'type' => 'type one',
            ],
            [
                'id' => rand(101, 200),
                'message' => 'test two',
                'type' => 'type two',
            ],
            [
                'id' => rand(201, 300),
                'message' => 'test three',
                'type' => 'type one',
            ],
            [
                'id' => rand(301, 400),
                'message' => 'test four',
                'type' => 'type one',
            ],
        ];

        array_walk($testData, [$this, 'insertData']);

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivitiesByType('type one', 2, 1);

        $this->assertNotFalse($data);
        $this->assertInternalType('array', $data);
        $this->assertCount(2, $data);

        $testData = array_filter($testData, function ($row) {
            return ($row['type'] == 'type one');
        });
        $testData = array_values($testData);
        $testData = array_slice($testData, 1, 2);

        foreach ($testData as $key => $testRow) {
            $this->assertInternalType('array', $testRow);
            $this->assertArraySubset($testRow, $data[$key]);
        }
    }

    public function testGetActivitiesByTypeRangeFailure()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'message' => 'test one',
                'type' => 'type one',
            ],
            [
                'id' => rand(101, 200),
                'message' => 'test two',
                'type' => 'type one',
            ],
            [
                'id' => rand(201, 300),
                'message' => 'test three',
                'type' => 'type one',
            ],
        ];

        array_walk($testData, [$this, 'insertData']);

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivitiesByType('type two', 2, 1);

        $this->assertEmpty($data);
        $this->assertInternalType('array', $data);
    }

    public function testGetActivitiesByTypeCount()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'message' => 'test one',
                'type' => 'type one',
            ],
            [
                'id' => rand(101, 200),
                'message' => 'test two',
                'type' => 'type two',
            ],
            [
                'id' => rand(201, 300),
                'message' => 'test three',
                'type' => 'type one',
            ],
        ];

        array_walk($testData, [$this, 'insertData']);

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivitiesByTypeCount('type one');

        $testData = array_filter($testData, function ($row) {
            return ($row['type'] == 'type one');
        });

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);
        $this->assertEquals(count($testData), $data);
    }

    public function testGetActivitiesByTypeCountEmpty()
    {
        $testData = [
            [
                'id' => rand(1, 100),
                'message' => 'test one',
                'type' => 'type one',
            ],
            [
                'id' => rand(101, 200),
                'message' => 'test two',
                'type' => 'type one',
            ],
        ];

        array_walk($testData, [$this, 'insertData']);

        $repository = new MysqlActivityRepository(self::$connection);
        $data = $repository->getActivitiesByTypeCount('type two');

        $this->assertNotFalse($data);
        $this->assertStringMatchesFormat('%d', $data);
        $this->assertEquals('0', $data);
    }

    protected function tearDown()
    {
        self::$connection->getDefault()->perform("DELETE FROM `jpemeric_stream`.`activity`");
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
            'message' => '',
            'message_long' => '',
            'datetime' => '',
            'metadata' => '',
            'type' => '',
            'type_id' => '',
        ];

        $data = array_merge($defaultData, $data);

        return self::$connection->getDefault()->perform("
            INSERT INTO `jpemeric_stream`.`activity`
                (id, message, message_long, datetime, metadata, type, type_id)
            VALUES
                (:id, :message, :message_long, :datetime, :metadata, :type, :type_id)",
            $data
        );
    }
}
