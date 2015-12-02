<?php

use Aura\Sql\ConnectionLocator;
use Aura\Sql\ExtendedPdo;
use Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository;

class MysqlPostRepositoryTest extends PHPUnit_Framework_TestCase
{

    protected $connections;

    public function __construct()
    {
        $extendedPdo = $this->newExtendedPdo();
        $this->connections = new ConnectionLocator(function () use ($extendedPdo) {
            return $extendedPdo;
        });
    }

    protected function newExtendedPdo()
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
        return $extendedPdo;
    }

    public function newMysqlPostRepository()
    {
        return new MysqlPostRepository($this->connections);
    }

    public function testConstructSetsConnections()
    {
        $this->assertAttributeEquals(
            $this->connections,
            'connections',
            $this->newMysqlPostRepository()
        );
    }

    public function testFindPostByPath()
    {
        $test_active_post = array(
            'title'     => 'test findByPath active',
            'path'      => 'test-findbypath-active',
            'category'  => 'test-category',
            'date'      => (new DateTime())->format('Y-m-d H:i:s'),
            'body'      => 'test content',
            'display'   => 1
        );

        $this->connections->getDefault()->perform("
            INSERT INTO jpemeric_blog.post
                (title, path, category, date, body, display)
            VALUES
                (:title, :path, :category, :date, :body, :display)",
            $test_active_post);

        $active_post = $this->newMysqlPostRepository()->findPostByPath(
            $test_active_post['category'],
            $test_active_post['path']
        );
        $this->assertSame($test_active_post['title'], $active_post['title']);

        $test_inactive_post = array(
            'title'     => 'test findByPath inactive',
            'path'      => 'test-findbypath-inactive',
            'category'  => 'test-category',
            'date'      => (new DateTime())->format('Y-m-d H:i:s'),
            'body'      => 'test content',
            'display'   => 0
        );

        $this->connections->getDefault()->perform("
            INSERT INTO jpemeric_blog.post
                (title, path, category, date, body, display)
            VALUES
                (:title, :path, :category, :date, :body, :display)",
            $test_inactive_post);

        $inactive_post = $this->newMysqlPostRepository()->findPostByPath(
            $test_inactive_post['category'],
            $test_inactive_post['path']
        );
        $this->assertFalse($inactive_post);

        $nonexistant_post = $this->newMysqlPostRepository()->findPostByPath(
            'test-category',
            'test-findbypath-nonexistant'
        );
        $this->assertFalse($nonexistant_post);
   }

    public function testIsInstanceOfPostRepository()
    {
        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Blog\Post\PostRepositoryInterface',
            $this->newMysqlPostRepository()
        );
    }

    public static function tearDownAfterClass()
    {
//        $this->connections->getDefault()->disconnect();
        unlink('jpemeric_blog.db');
    }
}
