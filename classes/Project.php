<?php


class Project {

    public $code, $name, $active;

    function __construct($code) {
        $this->code = $code;

        $query = "SELECT * FROM projects WHERE code = '$code'";
        $result = \DB::makeAQueryInUTF8($query);
        $infoArray = mysqli_fetch_array($result);

        $this->name = $infoArray["proj_name"];
        $this->active = $infoArray["active"];
    }

    function getAverageNumberOfParticipations() {
        $query = "SELECT SUM(fails + wins)/COUNT(id) FROM players WHERE project='$this->code'";
        $result = \DB::makeAQuery($query);
        $average = mysqli_fetch_array($result)[0];
        return $average;
    }

    function getPlayerIDs() {
        $average = $this->getAverageNumberOfParticipations();
        $average++;
        $query = "SELECT id FROM players WHERE project = '$this->code' AND fails + wins <= '$average'";
        $result = \DB::makeAQuery($query);

        $num_rows = mysqli_num_rows($result);

        if ($num_rows < MINIMUM_OF_PLAYERS_IN_PROJECT || $this->active == 0) {
            return false;
        }

        $arPlayerIDs = [];
        for ($i = 0; $i < $num_rows; $i++ ) {
            array_push($arPlayerIDs, mysqli_fetch_array($result)[0]);
        }

        return $arPlayerIDs;
    }

    function getRandomPairOfPlayers() {
        $players = $this->getPlayerIDs();
        if (!$players) {
            return false;
        }

        $number_of_candidates = count($players) - 1;
        $twoRandomNumbers = \GameEngine::getTwoRandomNumbers(0, $number_of_candidates);
        $pair = [
            "left" => $players[$twoRandomNumbers['first']],
            "right" => $players[$twoRandomNumbers['second']]
        ];

        return $pair;
    }

}