<?php

/**
 * Created by PhpStorm.
 * User: Aphazel
 * Date: 28.07.2017
 * Time: 0:11
 */


class Player {

    public $id, $name, $rating;

    function __construct($id) {
        $this->id = $id;

        global $db_server;
        $query = "SELECT name, rating, wins, fails FROM players WHERE id = '$id'";
        mysqli_query($db_server, "SET NAMES 'utf8'");
        $player_info = fromMysqlToArray($query);

        $this->name = mb_convert_encoding($player_info['name'], "UTF-8");
        $this->rating = mb_convert_encoding($player_info['rating'], "UTF-8");
        $this->wins = $player_info["wins"];
        $this->fails = $player_info["fails"];
    }

    public function getImgSrc($img_dir) {
        return $img_dir.$this->id.".jpg";
    }

}