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

}