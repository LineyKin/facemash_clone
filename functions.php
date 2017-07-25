<?php

function db_connect_server($db_hostname, $db_user, $db_name) {
	$db_server = mysqli_connect($db_hostname, $db_user);
	if (!$db_server) die("Невозможно подключиться к MySQL: ".mysqli_error($db_server));
	mysqli_select_db($db_server, $db_name) or die("Невозможно выбрать базу данных: ". mysqli_error($db_server));
	return $db_server;
}

function _p($something) {
	echo "<pre>";
	print_r($something);
	echo "</pre>";
}

function fromMysqlToArray($query) {
	global $db_server;
	$result = mysqli_query($db_server, $query);
	$array_info = mysqli_fetch_array($result);
	return $array_info;
}