<?php

    require __DIR__ . "/settings.php";

    function OpenConnection(){
        $mysqli = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE) or die(mysqli_connect_error());
        mysqli_set_charset($mysqli, CHARSET) or die(mysqli_error($mysqli));

        return $mysqli;
    }

    function FixCodeSql($data){
        $mysqli = OpenConnection();

        if(!is_array($data)){
            $dados = mysqli_real_escape_string($mysqli, $data);
        }else{
            foreach($data as $key => $value){
                $key = mysqli_real_escape_string($mysqli, $key);
                $value = mysqli_real_escape_string($mysqli, $value);

                $dados[$key] = $value;
            }

            CloseConnection($mysqli);
            return $data;
        }
    }

    function CloseConnection($mysqli){
        mysqli_close($mysqli) or die(mysqli_error($mysqli));
    }