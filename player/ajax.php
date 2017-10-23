<?php

require_once "../connectivity.php";

if($_POST['rating_graph']) {

    $player = new Player($_POST['player_id']);

    $ratingDynamics = $player->getDynamicsOfPersonalProps();

    echo json_encode($ratingDynamics);

}