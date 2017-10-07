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

        $r = $w/($w + $f);
        $r = $r*100;

        return round($r, 2);
    }
}