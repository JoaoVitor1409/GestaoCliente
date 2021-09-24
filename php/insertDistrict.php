<?php

    require __DIR__ . "/../admin/crud.php";

    $name = $_POST['name'];
    $city = $_POST['city'];

    if($name == ""){
        $return["code"] = "0";
        $return["message"] = "Nome não pode ser vazio";
    }elseif($city == ""){
        $return["code"] = "0";
        $return["message"] = "Cidade não pode ser vazio";
    }else{
        $data = [
            "BairroNome" => $name,
            "CidadeID" => 1
        ];
        if(Insert("Bairro",$data)){
            $return["code"] = "1";
            $return["message"] = "Bairro cadastrado com sucesso!";
        }
    }
    echo json_encode($return);