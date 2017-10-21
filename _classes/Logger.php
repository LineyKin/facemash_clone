<?php

class Logger {

    static function insertGameResultIntoDB($project, $winnerID, $looserID) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $query = "INSERT INTO gamelogs (ip, project, winner_id, looser_id) VALUES ('$ip', '$project', $winnerID, $looserID);";
        \DB::makeAQuery($query);
    }

    static function insertRatingAfterGame($playerID, $rating) {
        $query = "INSERT INTO rating_logs (player_id, rating) VALUES ('$playerID', '$rating');";
        \DB::makeAQuery($query);
    }

}