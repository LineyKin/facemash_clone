<?php

class Player {

    public $id, $project, $code, $name, $rating, $wins, $fails;
    protected $gameResult = NULL;

    function __construct($id, $project=NULL, $code=NULL, $name=NULL, $rating=NULL, $wins=NULL, $fails=NULL) {
        $this->id = $id;

        if($code == NULL) {

            global $db_server;
            $query = "SELECT * FROM players WHERE id = '$id'";
            mysqli_query($db_server, "SET NAMES 'utf8'");
            $player_info = fromMysqlToArray($query);

            $this->name = mb_convert_encoding($player_info['name'], "UTF-8");
            $this->rating = mb_convert_encoding($player_info['rating'], "UTF-8");
            $this->wins = $player_info["wins"];
            $this->fails = $player_info["fails"];
            $this->code = $player_info["code"];
            $this->project = $player_info["project"];
        }
        else {
            $this->name = $name;
            $this->rating = $rating;
            $this->wins = $wins;
            $this->fails = $fails;
            $this->code = $code;
            $this->project = $project;
        }
    }

    public function getImgSrc($img_dir) {
        return $img_dir.$this->project."/".$this->code.".jpg";
    }

    public function getShareOfWins() {
        $w = (int) $this->wins;
        $f = (int) $this->fails;

        if($w == 0 && $f == 0) {
            return false;
        }

        $all = $w + $f;
        $r = $w/$all;
        $r = $r*100;
        $r = round($r, 2);

        return (int) $r;

    }

    public function showShareOfWins() {
        $shareOfWins = $this->getShareOfWins();
        return is_int($shareOfWins) ? $shareOfWins."%" : "-";
    }

    public function getDynamicsOfPersonalProps() {

        $query = "SELECT rating, winner_index, time FROM personal_player_logs WHERE player_id=$this->id";
        $result = \DB::makeAQuery($query);
        $num_rows = mysqli_num_rows($result);

        $arRatingDynamics = [];

        for ($i = 0; $i < $num_rows; $i++ ) {
            $array = mysqli_fetch_array($result);
            array_push($arRatingDynamics, [
                'rating' => $array['rating'],
                'winner_index' => $array['winner_index'],
                'time' => $array['time']
            ]);
        }

        return $arRatingDynamics;
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
        $newRating = round($newRating, 2);

        return $newRating;

    }

    public function updateRatingInDB($newRating) {

        if ($this->gameResult == 1) {
            $query = "UPDATE players SET rating = $newRating, wins = $this->wins WHERE id = $this->id";
        }
        else {
            $query = "UPDATE players SET rating = $newRating, fails = $this->fails WHERE id = $this->id";
        }

        \DB::makeAQuery($query);
    }
}