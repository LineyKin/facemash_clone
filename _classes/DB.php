<?php


class DB {

    static function makeAQuery($query) {
        global $db_server;
        return mysqli_query($db_server, $query);
    }

    static  function makeAQueryInUTF8($query) {
        global $db_server;
        mysqli_query($db_server, "SET NAMES 'utf8'");
        return mysqli_query($db_server, $query);
    }

}