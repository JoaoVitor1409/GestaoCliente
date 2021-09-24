<?php

    require __DIR__ . "/settings.php";

    function OpenConnection(){
        $mysqli = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE) or die(mysqli_connect_error());
        mysqli_set_charset($mysqli, CHARSET) or die(mysqli_error($mysqli));

        return $mysqli;
    }

    function CloseConnection($mysqli){
        mysqli_close($mysqli) or die(mysqli_error($mysqli));
    }