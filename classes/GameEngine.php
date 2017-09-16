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

    static function getPlayerIDsByProjectCode($projectCode) {
        $query = "SELECT id FROM players WHERE project = '$projectCode'";
        $result = \DB::makeAQuery($query);

        $num_rows = mysqli_num_rows($result);

        $arPlayerIDs = [];
        for ($i = 0; $i < $num_rows; $i++ ) {
            array_push($arPlayerIDs, mysqli_fetch_array($result)[0]);
        }

        return $arPlayerIDs;
    }

    static function getRandomPairOfPlayers($projectCode) {
        $players = self::getPlayerIDsByProjectCode($projectCode);
        $number_of_candidates = count($players) - 1;
        $twoRandomNumbers = self::getTwoRandomNumbers(1, $number_of_candidates);

        $pair = [
            "left" => $players[$twoRandomNumbers['first']],
            "right" => $players[$twoRandomNumbers['second']]
        ];

        return $pair;
    }

}