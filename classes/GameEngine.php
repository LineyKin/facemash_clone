<?php

class GameEngine {

    static function getTwoRandomNumbers($from, $to) {
        $first = rand($from, $to);
        $second = rand($from, $to);

        while ($first == $second) {
            $second = rand($from, $to);
        }

        return ['first' => $first, 'second' => $second];
    }

    static function getAverageNumberOfParticipations() {
        $query = "SELECT SUM(fails + wins)/COUNT(id) FROM players";
        $result = \DB::makeAQuery($query);
        $average = mysqli_fetch_array($result)[0];
        return $average;
    }

    static function getPlayerIDsByProjectCode($projectCode) {
        $average = self::getAverageNumberOfParticipations();
        $average++;
        $query = "SELECT id FROM players WHERE project = '$projectCode' AND fails + wins <= '$average'";
        $result = \DB::makeAQuery($query);

        $num_rows = mysqli_num_rows($result);

        if ($num_rows < MINIMUM_OF_PLAYERS_IN_PROJECT) {
            return false;
        }

        $arPlayerIDs = [];
        for ($i = 0; $i < $num_rows; $i++ ) {
            array_push($arPlayerIDs, mysqli_fetch_array($result)[0]);
        }

        return $arPlayerIDs;
    }

    static function getRandomPairOfPlayers($projectCode) {
        $players = self::getPlayerIDsByProjectCode($projectCode);
        if (!$players) {
            return false;
        }

        $number_of_candidates = count($players) - 1;
        $twoRandomNumbers = self::getTwoRandomNumbers(0, $number_of_candidates);
        $pair = [
            "left" => $players[$twoRandomNumbers['first']],
            "right" => $players[$twoRandomNumbers['second']]
        ];

        return $pair;
    }

}