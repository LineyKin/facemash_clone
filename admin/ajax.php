<?php
require_once "../connectivity.php";

if(isset($_POST['project_name'])) {
    $project_name = $_POST['project_name'];
    $code = \StringConverter::translit($project_name);
    \Admin::insertNewProjectIntoDB($project_name, $code);
    mkdir("../_images/".$code);

    $project = [
        "name" => $project_name,
        "code" => $code
    ];

    echo json_encode($project);
}


if ( isset($_FILES['playerPhoto']) && isset($_POST['name']) ) {
    $projectCode = $_POST['code'];
    $name = $_POST['name'];
    $code = \StringConverter::translit($name); // код игрока и имя его фотки - одно и то же
    move_uploaded_file($_FILES['playerPhoto']['tmp_name'], '../_images/'.$projectCode.'/'.$code.'.jpg');

    \Admin::insertNewPlayerIntoProject($projectCode, $code, $name);
}


if(isset($_POST['get_list'])) {
    $projectCode = $_POST['project_code'];
    $project = new Project($projectCode);
    $playerList = $project->getPlayersOrderByName();

    echo json_encode($playerList);
}

if (isset($_POST['delete_player'])) {
    $playerID = $_POST['player_id'];
    $player = new Player($playerID);

    $imgSrc = $player->imgSrc;
    if (unlink($_SERVER['DOCUMENT_ROOT'].$imgSrc)) {
        if($player->deletePlayerFromDB()) {
            echo 1;
        }
        else {
            echo 0;
        }
    }
    else {
        echo "фото не удалено";
    }

}
