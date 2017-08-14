<?php

class Logger {

    static function insertGameResultInDB($winnerID, $looserID) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $query = "INSERT INTO gamelogs (ip, winner_id, looser_id) VALUES ('$ip', $winnerID, $looserID);";
        global $db_server;
        return mysqli_query($db_server, $query);
    }

}