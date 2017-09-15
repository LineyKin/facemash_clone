<?php

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

        while ($first == $second) {
            $second = rand($from, $to);
        }

        return ['first' => $first, 'second' => $second];
    }


    static function getPlayerCodesByProjectCode($projectCode) {
        $query = "SELECT code FROM players WHERE project = '$projectCode'";
        $result = \DB::makeAQuery($query);

        $num_rows = mysqli_num_rows($result);

        $All = [];
        for ($i = 0; $i < $num_rows; $i++ ) {
            array_push($All, mysqli_fetch_array($result)[0]);
        }

        return $All;
    }


    // СТАРЫЙ ВЫВОД ПАРЫ (БУДЕТ УДАЛЕНО)
    static function getRandomPairOfPlayers($img_dir) {
        $dir = scandir($img_dir);
        $number_of_candidates = count($dir) - 2; //2 левых файла
        $twoRandomNumbers = self::getTwoRandomNumbers(1, $number_of_candidates);

        $pair = [
            "left" => $twoRandomNumbers['first'],
            "right" => $twoRandomNumbers['second']
        ];

        return $pair;

    }

    // НОВЫЙ ВЫВОД ПАРЫ
    static function getRandomPairOfPlayers_2($projectCode) {
        $players = self::getPlayerCodesByProjectCode($projectCode);
        $number_of_candidates = count($players) - 1;
        $twoRandomNumbers = self::getTwoRandomNumbers(1, $number_of_candidates);

        $pair = [
            "left" => $players[$twoRandomNumbers['first']],
            "right" => $players[$twoRandomNumbers['second']]
        ];

        return $pair;
    }

}