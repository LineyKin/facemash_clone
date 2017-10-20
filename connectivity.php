<?php

$classesDir =  "_classes/";
$dir =  "_connectivity/";

require_once $dir."db_connect.php";
require_once $dir."functions.php";
require_once $dir."conf.php";

$db_server = db_connect_server($db_hostname, $db_user, $db_name, $db_password);

// ПОДКЛЮЧЕНИЕ КЛАССОВ
require_once $classesDir."GameEngine.php";
require_once $classesDir."Player.php";
require_once $classesDir."Logger.php";
require_once $classesDir."StringConverter.php";
require_once $classesDir."Admin.php";
require_once $classesDir."DB.php";
require_once $classesDir."Project.php";