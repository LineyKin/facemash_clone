<?php


class Admin {

    static  function insertNewProjectIntoDB($name, $code) {

        $query = "INSERT INTO projects (code, proj_name) VALUES ('$name', '$code')";
        global $db_server;
        mysqli_query($db_server, "SET NAMES 'utf8'");
        return mysqli_query($db_server, $query);
    }

}