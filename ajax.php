<?php

require_once "functions.php";
require_once "classes.php";
require_once "db_connect.php";
require_once "conf.php";


$winer = new PlayerWithEloRating($_POST["winer_id"]);
$looser = new PlayerWithEloRating($_POST["looser_id"]);

Logger::insertGameResultInDB($winer->id, $looser->id);


$winerRating = $winer->rating;
$looserRating = $looser->rating;

$newWinerRating = $winer->calculateNewRating(1, $looserRating);
$newLooserRating = $looser->calculateNewRating(0, $winerRating);

$winer->updateRatingInDB($newWinerRating);
$looser->updateRatingInDB($newLooserRating);


$new_pair = GameEngine::getRandomPairOfPlayers(IMG_DIR);

$l_id = $new_pair["left"];
$r_id = $new_pair["right"];

$l_player_new = new PlayerWithEloRating($l_id);
$r_player_new = new PlayerWithEloRating($r_id);

$new_players = [
	"left" => [
		"id" 	  => $l_id,
		"name" 	  => $l_player_new->name,
		"src_img" => $l_player_new->getImgSrc(IMG_DIR),
	],
	"right" => [
		"id" 	  => $r_id,
		"name" 	  => $r_player_new->name,
		"src_img" => $r_player_new->getImgSrc(IMG_DIR),
	]
];

echo json_encode($new_players);