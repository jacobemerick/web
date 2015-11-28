<?php

use Aura\Sql\ConnectionLocator;
use Aura\Sql\ExtendedPdo;
use Jacobemerick\Web\Domain\Blog\MysqlPostRepository;

class MysqlPostRepositoryTest extends \PHPUnit_Framework_TestCase
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

    public function testFindByUri()
    {
        $test_post = array(
            'title' => 'test title',
            'path' => 'test-uri',
            'category' => 'test',
            'date' => date('Y-m-d H:i:s'),
            'body' => 'test content',
            'display' => 1
        );

        $this->connections->getDefault()->perform("
            INSERT INTO jpemeric_blog.post
                (title, path, category, date, body, display)
            VALUES
                (:title, :path, :category, :date, :body, :display)",
            $test_post);

        $post = $this->newMysqlPostRepository()->findByUri($test_post['path']);
        $this->assertSame($test_post['path'], $post['path']);
    }

    public function testIsInstanceOfPostRepository()
    {
        $this->assertInstanceOf(
            'Jacobemerick\Web\Domain\Blog\PostRepository',
            $this->newMysqlPostRepository()
        );
    }

    public static function tearDownAfterClass()
    {
//        $this->connections->getDefault()->disconnect();
        unlink('jpemeric_blog.db');
    }
}
