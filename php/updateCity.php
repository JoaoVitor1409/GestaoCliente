<?php

    require __DIR__ . "/../admin/crud.php";

$id = $_POST['id'];
$name = $_POST['name'];
$state = $_POST['state'];

if($id == ""){
    $return["code"] = "0";
    $return["message"] = "ID não pode ser vazio";
}else{
    $datas = [];

    if($name != ""){
        $datas["CidadeNome"] = $name;
    }
    if($state != ""){
        $datas["CidadeUF"] = $state;
    }
    if ($datas){
        $condition = [
            "CidadeID" => $id
        ];
        if(Update("Cidade", $datas, $condition)){
            $return["code"] = "1";
            $return["message"] = "Cidade atualizada com Sucesso!";
        }
    }else{
        $return["code"] = "0";
        $return["message"] = "Todos os campos vazios!";
    }    
}

    echo json_encode($return);