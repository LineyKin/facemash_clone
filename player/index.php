<?php

require_once "../connectivity.php";


$playerID = $_GET['code'];

$player = new Player($playerID);

_p($player);