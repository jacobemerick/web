<?php

namespace Jacobemerick\Web\Domain\Stream\Changelog;

use Aura\Sql\ConnectionLocator;
use Aura\Sql\ExtendedPdo;
use PHPUnit_Framework_TestCase;

class MysqlChangelogRepositoryTest extends PHPUnit_Framework_TestCase
{

    public function testIsInstanceOfChangelogRepository()
    {
        $repository = new MysqlChangelogRepository(new ConnectionLocator());

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Stream\Changelog\MysqlChangelogRepository',
            $repository
        );
    }

    public function testImplementsChangelogInterface()
    {
        $repository = new MysqlChangelogRepository(new ConnectionLocator());

        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Stream\Changelog\ChangelogRepositoryInterface',
            $repository
        );
    }

    public function testConstructSetsConnections()
    {
        $connection = new ConnectionLocator();
        $respository = new MysqlChangelogRepository($connection);

        $this->assertAttributeSame(
            $connection,
            'connections',
            $respository
        );
    }
}
