<?php

namespace Jacobemerick\Web\Domain\Stream\Activity;

use Aura\Sql\ConnectionLocator;
use Aura\Sql\ExtendedPdo;
use PHPUnit_Framework_TestCase;

class MysqlActivityRepositoryTest extends PHPUnit_Framework_TestCase
{

    public function testIsInstanceOfActivityRepository()
    {
        $repository = new MysqlActivityRepository(new ConnectionLocator());

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Stream\Activity\MysqlActivityRepository',
            $repository
        );
    }

    public function testImplementsActivityInterface()
    {
        $repository = new MysqlActivityRepository(new ConnectionLocator());

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Stream\Activity\ActivityRepositoryInterface',
            $repository
        );
    }

    public function testConstructSetsConnections()
    {
        $connection = new ConnectionLocator();
        $respository = new MysqlActivityRepository($connection);

        $this->assertAttributeSame(
            $connection,
            'connections',
            $respository
        );
    }
}
