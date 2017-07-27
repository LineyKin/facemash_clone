<?php
require_once "db_connect.php";
require_once "functions.php";

$db_server = db_connect_server($db_hostname, $db_user, $db_name);

require_once "classes/GameEngine.php";
require_once "classes/Player.php";
require_once "classes/PlayerWithEloRating.php";
require_once "classes/Logger.php";