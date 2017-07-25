<?php

class DataBase  {

	public $hostname, $user, $name, $server;
	
	function __construct() {
		$this->hostname = 'localhost';
		$this->user = 'root';
		$this->name = 'nameofrussia';
		$this->server = mysqli_connect($this->hostname, $this->user);
	}

	static function connectServer() {
		$dbServer = $this->server;

		if (!$dbServer) {
			die("Невозможно подключиться к MySQL: ".mysqli_error($dbServer));
		}

		mysqli_select_db($dbServer, $db_name) or die("Невозможно выбрать базу данных: ". mysqli_error($dbServer));

		return $dbServer;
	}

	static function fromMysqlToArray($query) {
		$result = mysqli_query($this->server, $query);
		$arrayInfo = mysqli_fetch_array($result);
		return $arrayInfo;
	}
}

?>