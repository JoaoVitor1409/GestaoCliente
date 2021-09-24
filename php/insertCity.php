<?php

    require __DIR__ . "/../admin/crud.php";

    $name = $_POST['name'];
    $state = $_POST['state'];

    if($name == ""){
        $return["code"] = "0";
        $return["message"] = "Nome não pode ser vazio";
    }elseif($state == ""){
        $return["code"] = "0";
        $return["message"] = "Estado não pode ser vazio";
    }else{
        $data = [
            "CidadeNome" => $name,
            "CidadeUF" => $state
        ];
        if(Insert("Cidade",$data)){
            $return["code"] = "1";
            $return["message"] = "Cidade cadastrada com sucesso!";
        }
    }
    echo json_encode($return);