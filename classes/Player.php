<?php

class Player {

    public $id, $name, $rating;

    function __construct($id, $project=NULL, $code=NULL, $name=NULL, $rating=NULL, $wins=NULL, $fails=NULL) {
        $this->id = $id;

        if($code == NULL) {

            global $db_server;
            $query = "SELECT name, code, rating, wins, fails FROM players WHERE id = '$id'";
            mysqli_query($db_server, "SET NAMES 'utf8'");
            $player_info = fromMysqlToArray($query);

            $this->name = mb_convert_encoding($player_info['name'], "UTF-8");
            $this->rating = mb_convert_encoding($player_info['rating'], "UTF-8");
            $this->wins = $player_info["wins"];
            $this->fails = $player_info["fails"];
            $this->code = $player_info["code"];
        }
        else {
            $this->name = $name;
            $this->rating = $rating;
            $this->wins = $wins;
            $this->fails = $fails;
            $this->code = $code;
        }
    }

    public function getImgSrc($img_dir) {
        return $img_dir.$this->code.".jpg";
    }

    public function getShareOfWins() {
        $w = (int) $this->wins;
        $f = (int) $this->fails;

        $all = $w + $f;

        $r = NULL;

        if ($all > 0) {
            $r = $w/$all;
            $r = $r*100;
            $r = round($r, 2);
            $r = $r."%";
        }
        else {
            $r = "-";
        }

        return $r;
    }




    /*МЕТОДЫ ДЛЯ РЕЙТИНГА ЭЛО*/

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
            $query = "UPDATE players SET rating = $newRating, wins = $all_wins WHERE id = $this->id";

        }
        else {

            $all_fails = $this->fails + 1;
            $query = "UPDATE players SET rating = $newRating, fails = $all_fails WHERE id = $this->id";

        }

        \DB::makeAQuery($query);
    }
}