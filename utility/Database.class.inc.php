<?php

final class Database
{

	private $read_connection;
	private $write_connection;
	private $query_log = array();
	private $query_total = array(
		'count' => 0,
		'time' => 0);

	private $has_connection_error = false;

	private static $instance;

	private function __construct($write_params, $read_params)
	{
        $this->write_connection = $this->connect(
            $write_params->host,
            $write_params->user,
            $write_params->password
        );

        $this->read_connection = $this->connect(
            $read_params->host,
            $read_params->user,
            $read_params->password
        );

		return $this;
	}

	private function connect($host, $username, $password)
	{
		$mysqli = new mysqli($host, $username, $password);
		
		$has_connection_error = $mysqli->connect_error;
		if(isset($has_connection_error))
			$this->has_connection_error = true;
		
		return $mysqli;
	}

	public static function instance()
	{
		if(!isset(self::$instance)) {
            global $config;
            self::$instance = new Database(
                $config->database->master,
                $config->database->slave
            );
        }

		return self::$instance;
	}

	public static function escape($string)
	{
		return self::instance()->read_connection->real_escape_string($string);
	}

	public static function select($query)
	{
		$start = microtime(true);
		if($result = self::instance()->read_connection->query($query))
		{
			self::instance()->log_query($query, $start);
			$array = array();
			while($row = $result->fetch_object())
				$array[] = $row;
			$result->close();
			return $array;
		}
		trigger_error('Could not preform query - ' . $query . ' - ' . self::instance()->read_connection->error);
		return false;
	}

	public static function selectRow($query)
	{
		$result = self::select($query);
		if(is_array($result))
			return array_pop($result);
		return false;
	}

	public static function execute($query)
	{
		$start = microtime(true);
		if(self::instance()->write_connection->query($query))
		{
			self::instance()->log_query($query, $start);
			return true;
		}
		trigger_error('Could not preform query - ' . $query . '-' . self::instance()->write_connection->error);
		return false;
	}

	public static function lastInsertID()
	{
		$id = self::instance()->write_connection->insert_id;
		if($id == 0)
			return false;
		return $id;
	}

	private function log_query($query, $start)
	{
		$time = (microtime(true) - $start) * 1000;
		$query = array(
			'sql' => $query,
			'time' => $time);
		array_push($this->query_log, $query);
		
		$this->query_total['count']++;
		$this->query_total['time'] += $time;
	}

	private function gather_query_data()
	{
		$query_data = array();
		foreach($this->query_log as $query)
		{
			$query = self::explain($query);
			$query_data[] = $query;
		}
		return $query_data;
	}

	public static function explain($query)
	{
		$sql = 'EXPLAIN ' . $query['sql'];
		
		if($result = self::instance()->read_connection->query($sql))
		{
			$row = $result->fetch_assoc();
			$query['explain'] = $row;
		}
		
		return $query;
	}

	public static function getQueryLog()
	{
		return self::instance()->gather_query_data();
	}

	public static function getQueryTotals()
	{
		return self::instance()->query_total;
	}

	public static function isConnected()
	{
		return !self::instance()->has_connection_error;
	}

}
