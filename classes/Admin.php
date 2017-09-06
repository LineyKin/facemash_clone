<?php


class Admin {

    static  function insertNewProjectIntoDB($name, $code) {

        $query = "INSERT INTO projects (code, proj_name) VALUES ('$code', '$name')";
        global $db_server;
        mysqli_query($db_server, "SET NAMES 'utf8'");
        return mysqli_query($db_server, $query);
    }

    static function getAllProjects() {
        global $db_server;
        mysqli_query($db_server, "SET NAMES 'utf8'");
        $query = "SELECT * FROM projects";
        $result = mysqli_query($db_server, $query);
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

}