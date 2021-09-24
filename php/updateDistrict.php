<?php

    require __DIR__ . "/../admin/crud.php";

$id = $_POST['id'];
$name = $_POST['name'];
$state = $_POST['state'];
$city = $_POST['city'];

if($id == ""){
    $return["code"] = "0";
    $return["message"] = "ID não pode ser vazio";
}else{
    $datas = [];

    if($name != ""){
        $datas["BairroNome"] = $name;
    }
    if($state != ""){
        $condition = [
            "CidadeNome" => $city,
            "CidadeUF" => $state
        ];
        $resultCity = Read("Cidade","CidadeID, CidadeNome",$condition);
        if($resultCity){
            $cityID = $resultCity[0]['CidadeID'];
            $datas["CidadeID"] = $cityID;
        }else{      
            $data = [
                "CidadeNome" => $city,
                "CidadeUF" => $state
            ];
            Insert("Cidade", $data);

            $condition = [
                "CidadeNome" => $city,
                "CidadeUF" => $state
            ];
            $resultCity = Read("Cidade","CidadeID, CidadeNome",$condition);
            $cityID = $resultCity[0]['CidadeID'];
            $datas["CidadeID"] = $cityID;
        }
    }
    if ($datas){
        $condition = [
            "BairroID" => $id
        ];
        if(Update("Bairro", $datas, $condition)){
            $return["code"] = "1";
            $return["message"] = "Bairro atualizado com Sucesso!";
        }
    }else{
        $return["code"] = "0";
        $return["message"] = "Todos os campos vazios!";
    }    
}

    echo json_encode($return);