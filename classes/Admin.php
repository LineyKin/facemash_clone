<?php


class Admin {


    static function getAllProjects() {
        $query = "SELECT * FROM projects";
        $result = \DB::makeAQueryInUTF8($query);
        $num_rows = mysqli_num_rows($result);

        $All = [];
        for ($i = 0; $i < $num_rows; $i++ ) {
            array_push($All, mysqli_fetch_array($result));
        }

        foreach ($All as $key => &$value) {
            mb_convert_encoding($value['proj_name'], "UTF-8");
        }

        return $All;
    }

    static function insertNewProjectIntoDB($name, $code) {
        $query = "INSERT INTO projects (code, proj_name) VALUES ('$code', '$name')";
        \DB::makeAQueryInUTF8($query);
    }

    static function insertNewPlayerIntoProject($projectCode, $code, $name) {
        $query = "INSERT INTO players (project, code, name, rating, wins, fails) VALUES ('$projectCode', '$code', '$name', 400, 0, 0)";
       \DB::makeAQueryInUTF8($query);
    }

}