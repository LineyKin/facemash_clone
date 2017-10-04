<?php

require_once "_connectivity.php";


$winner = new PlayerWithEloRating($_POST["winner_id"]);
$looser = new PlayerWithEloRating($_POST["looser_id"]);
$projectCode = $_POST['projectCode'];

Logger::insertGameResultIntoDB($projectCode, $winner->id, $looser->id);


$winnerRating = $winner->rating;
$looserRating = $looser->rating;

$newWinnerRating = $winner->calculateNewRating(1, $looserRating);
$newLooserRating = $looser->calculateNewRating(0, $winnerRating);

$winner->updateRatingInDB($newWinnerRating);
$looser->updateRatingInDB($newLooserRating);

$project = new Project($projectCode);
$new_pair = $project->getRandomPairOfPlayers();


$l_id = $new_pair["left"];
$r_id = $new_pair["right"];

$l_player_new = new PlayerWithEloRating($l_id);
$r_player_new = new PlayerWithEloRating($r_id);

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