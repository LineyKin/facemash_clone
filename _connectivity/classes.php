<?php
require_once "db_connect.php";
require_once "functions.php";

$db_server = db_connect_server($db_hostname, $db_user, $db_name, $db_password);
$dir =  $_SERVER['DOCUMENT_ROOT']."/dvastula/_classes/";

require_once $dir."GameEngine.php";
require_once $dir."Player.php";
require_once $dir."Logger.php";
require_once $dir."StringConverter.php";
require_once $dir."Admin.php";
require_once $dir."DB.php";
require_once $dir."Project.php";