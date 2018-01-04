<?php


class Project {

    public $code, $name;
    protected $active;

    function __construct($id) {
        $this->id = $id;

        $query = "SELECT * FROM projects WHERE id = '$id'";
        $result = \DB::makeAQueryInUTF8($query);
        $infoArray = mysqli_fetch_array($result);

        $this->name = $infoArray["proj_name"];
        $this->active = $infoArray["active"];
        $this->code = $infoArray['code'];
    }

    function getAverageNumberOfParticipations() {
        $query = "SELECT SUM(fails + wins)/COUNT(id) FROM players WHERE project_id='$this->id'";
        $result = \DB::makeAQuery($query);
        $average = mysqli_fetch_array($result)[0];
        return $average;
    }

    function getPlayerIDs() {
        $average = $this->getAverageNumberOfParticipations();
        $average++;
        $query = "SELECT id FROM players WHERE project_id = '$this->id' AND fails + wins <= '$average'";
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
            "left" => $players[$twoRandomNumbers[0]],
            "right" => $players[$twoRandomNumbers[1]]
        ];

        return $pair;
    }

    protected function getPlayersOrderBy($field, $desc = NULL) {
        $desc = ($desc == 1) ? "DESC" : NULL;
        $query = "SELECT t0.*, t1.code AS project 
                  FROM players AS t0 
                  LEFT JOIN projects AS t1 ON t0.project_id = t1.id 
                  WHERE project_id = $this->id ORDER BY $field $desc";
        $result = \DB::makeAQuery($query);
        $arPlayers = \DB::getSimpleList($result);

        return $arPlayers;
    }


    function getPlayersOrderByRating() {
        return $this->getPlayersOrderBy("rating", 1);
    }

    function getPlayersOrderByName() {
        return $this->getPlayersOrderBy("name");
    }

}