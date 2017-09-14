<?php

/**
 * Created by PhpStorm.
 * User: Aphazel
 * Date: 28.07.2017
 * Time: 0:13
 */



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

        \DB::makeAQuery($query);
    }

}