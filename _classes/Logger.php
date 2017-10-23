<?php

class Logger {

    static function insertGameResultIntoDB($project, $winnerID, $looserID) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $query = "INSERT INTO gamelogs (ip, project, winner_id, looser_id) VALUES ('$ip', '$project', $winnerID, $looserID);";
        \DB::makeAQuery($query);
    }

    static function insertPersonalPlayerLogsIntoDB($playerID, $rating, $winnerIndex) {
        $query = "INSERT INTO personal_player_logs (player_id, rating, winner_index) 
                  VALUES ('$playerID', '$rating', '$winnerIndex');";
        \DB::makeAQuery($query);
    }

}