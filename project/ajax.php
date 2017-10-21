<?php

require_once "../connectivity.php";



$winner = new Player($_POST["winner_id"]);
$looser = new Player($_POST["looser_id"]);
$projectCode = $_POST['projectCode'];

Logger::insertGameResultIntoDB($projectCode, $winner->id, $looser->id);


$winnerRating = $winner->rating;
$looserRating = $looser->rating;

$newWinnerRating = $winner->calculateNewRating(1, $looserRating);
$newLooserRating = $looser->calculateNewRating(0, $winnerRating);

$winner->updateRatingInDB($newWinnerRating);
$looser->updateRatingInDB($newLooserRating);

Logger::insertRatingAfterGame($winner->id, $newWinnerRating);
Logger::insertRatingAfterGame($looser->id, $newLooserRating);

$project = new Project($projectCode);
$new_pair = $project->getRandomPairOfPlayers();


$l_id = $new_pair["left"];
$r_id = $new_pair["right"];

$l_player_new = new Player($l_id);
$r_player_new = new Player($r_id);

$new_players = [
	"left" => [
		"id" 	  => $l_id,
		"name" 	  => $l_player_new->name,
		"src_img" => $l_player_new->getImgSrc('../'.IMG_DIR.$projectCode.'/'),
	],
	"right" => [
		"id" 	  => $r_id,
		"name" 	  => $r_player_new->name,
		"src_img" => $r_player_new->getImgSrc('../'.IMG_DIR.$projectCode.'/'),
	]
];

echo json_encode($new_players);