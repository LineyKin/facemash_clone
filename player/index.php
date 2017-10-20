<?php

require_once "../functions.php";
require_once "../classes.php";
require_once "../conf.php";

$playerID = $_GET['code'];

$player = new Player($playerID);

_p($player);