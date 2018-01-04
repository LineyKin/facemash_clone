<?php

class Player {

    public $id, $project, $code, $name, $rating, $wins, $fails;
    protected $gameResult = NULL;

    function __construct($id, $project_id=NULL, $project=NULL, $code=NULL, $name=NULL, $rating=NULL, $wins=NULL, $fails=NULL) {
        $this->id = $id;

        if($code == NULL) {

            global $db_server;
            $query = "SELECT t0.*, t1.code AS project  
                      FROM players AS t0 
                      LEFT JOIN projects AS t1 ON t0.project_id = t1.id 
                      WHERE t0.id = '$id'";
            mysqli_query($db_server, "SET NAMES 'utf8'");
            $player_info = fromMysqlToArray($query);

            $this->name = mb_convert_encoding($player_info['name'], "UTF-8");
            $this->rating = mb_convert_encoding($player_info['rating'], "UTF-8");
            $this->wins = $player_info["wins"];
            $this->fails = $player_info["fails"];
            $this->code = $player_info["code"];
            $this->project_id = $player_info["project_id"];
            $this->project = $player_info["project"];
        }
        else {
            $this->name = $name;
            $this->rating = $rating;
            $this->wins = $wins;
            $this->fails = $fails;
            $this->code = $code;
            $this->project = $project;
            $this->project_id = $project_id;
        }

        $this->imgSrc = "/".GLOBAL_PROJECT_NAME.IMG_DIR.$this->project."/".$this->code.".jpg";
    }


    /* МЕТОДЫ УДАЛЕНИЯ */

    public function deletePlayerFromPlayers() {
        $query = "DELETE FROM players WHERE id=$this->id";
        return \DB::makeAQuery($query);
    }

    public function deletePlayerFromGamelogs() {
        $id = $this->id;
        $query = "DELETE FROM gamelogs WHERE winner_id=$id OR looser_id=$id";
        return \DB::makeAQuery($query);
    }

    public function deletePlayerFromPPL() { //PPL - personal_player_logs, table in DB
        $query = "DELETE FROM personal_player_logs WHERE player_id=$this->id";
        return \DB::makeAQuery($query);
    }

    public function deletePlayerFromDB() {
        $status = [];
        array_push($status, self::deletePlayerFromGamelogs());
        array_push($status, self::deletePlayerFromPlayers());
        array_push($status, self::deletePlayerFromPPL());

        if (!in_array(false, $status)) {
            return true;
        }
        else {
            return false;
        }

    }

    /* МЕТОДЫ УДАЛЕНИЯ */


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