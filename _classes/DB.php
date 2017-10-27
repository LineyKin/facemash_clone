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

    static function getSimpleList($queryResult) {
        $num_rows = mysqli_num_rows($queryResult);

        $list = [];
        for ($i = 0; $i < $num_rows; $i++ ) {
            array_push($list, mysqli_fetch_array($queryResult));
        }

        return $list;
    }

}