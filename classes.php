<?php

require_once "db_connect.php";
require_once "functions.php";
require_once "conf.php";

$db_server = db_connect_server($db_hostname, $db_user, $db_name);



class GameEngine {

	static function getArrayOfIDsByImgNames($img_dir) {

		$dir_content = scandir($img_dir);

		foreach ($dir_content as $key => $value) {
			if (!preg_match("/^[0-9]/", $value)) {
				unset($dir_content[$key]);
			}
			else {
				$id = explode('.', $value)[0];
				$dir_content[$key] = $id;
			}
		}

		return array_values($dir_content);

	}

	static function getAllPairs($img_dir) {
		$ids = self::getArrayOfIDsByImgNames($img_dir);
		$all_ids = count($ids);
		$id_pairs = [];

		for ($i = 0; $i < $all_ids; $i++) { 
			for ($j = $i; $j < $all_ids; $j++) {
				$pair = [];
				if ($ids[$i] != $ids[$j]) {
					array_push($pair, $ids[$i]);
					array_push($pair, $ids[$j]);
					array_push($id_pairs, $pair);
				}
			}
		}
		//_p($id_pairs);
		return $id_pairs;
	}
	
	static function getTwoRandomNumbers($from, $to) {
		$first = rand($from, $to);
		$second = rand($from, $to);

		/*while ($first == $second) {
			$second = rand($from, $to);
		}*/

		return ['first' => $first, 'second' => $second];
	}



	static function getRandomPairOfPlayers($img_dir) {
        $dir = scandir($img_dir);
        _p($dir);
		$number_of_candidates = count($dir) - 2; //2 левых файла
		$twoRandomNumbers = self::getTwoRandomNumbers(1, $number_of_candidates);

		$pair = [
			"left" => $twoRandomNumbers['first'],
			"right" => $twoRandomNumbers['second']
		];

		return $pair;

	}

}



class Player {

	public $id, $name, $rating;
	
	function __construct($id) {
		$this->id = $id;

		global $db_server;
		$query = "SELECT name, rating, wins, fails FROM players WHERE id = '$id'";
		mysqli_query($db_server, "SET NAMES 'utf8'");
		$player_info = fromMysqlToArray($query);
		
		$this->name = mb_convert_encoding($player_info['name'], "UTF-8");
		$this->rating = mb_convert_encoding($player_info['rating'], "UTF-8");
		$this->wins = $player_info["wins"];
		$this->fails = $player_info["fails"];
	}

	public function getImgSrc($img_dir) {
		return $img_dir.$this->id.".jpg";
	}

}




class PlayerWithEloRating extends Player {

	public function getE($opponentRating) {

		$step1 = $opponentRating - $this->rating;
		$step2 = $step1 / 400;
		$step3 = 1 + pow(10, $step2);
		$E = 1 / $step3;

		return $E;
	}

	public function calculateNewRating($gameResult, $opponentRating) {

		$this->gameResult = $gameResult;

		$E = $this->getE($opponentRating);
		$R = $this->rating;
		$K = $R < 2400 ? 20 : 10;

		$newRating = $R + $K * ($gameResult - $E);

		return $newRating;

	}

	public function updateRatingInDB($newRating) {

		if ($this->gameResult == 1) {

			$all_wins = $this->wins + 1;
			$query = "UPDATE players SET rating = $newRating, wins = $all_wins WHERE id = $this->id;";

		}
		else {

			$all_fails = $this->fails + 1;
			$query = "UPDATE players SET rating = $newRating, fails = $all_fails WHERE id = $this->id;";

		}

		global $db_server;
		return mysqli_query($db_server, $query);
	}
	
}



class Logger {

	static function insertGameResultInDB($winnerID, $looserID) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$query = "INSERT INTO gamelogs (ip, winner_id, looser_id) VALUES ('$ip', $winnerID, $looserID);";
		global $db_server;
		return mysqli_query($db_server, $query);
	}

}