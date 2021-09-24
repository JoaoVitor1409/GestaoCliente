<?php

    require __DIR__ . "/../admin/crud.php";

$id = $_POST['id'];
$name = $_POST['name'];
$photo = $_POST['photo'];
$state = $_POST['state'];
$city = $_POST['city'];
$district = $_POST['district'];

if($id == ""){
    $return["code"] = "0";
    $return["message"] = "ID não pode ser vazio";
}else{
    $datas = [];

    if($name != ""){
        $datas["ClienteNome"] = $name;
    }
    if($photo != ""){
        $datas["ClienteFoto"] = $photo;
    }
    if($state != ""){
        if($city != ""){
            $condition = [
                "CidadeNome" => $city,
                "CidadeUF" => $state
            ];
            $resultCity = Read("Cidade","CidadeID, CidadeNome",$condition);
            if($resultCity){
                $cityID = $resultCity[0]['CidadeID'];

                $condition = [
                    "BairroNome" => $district,
                    "CidadeID" => $cityID
                ];
                $resultDistrict = Read("Bairro", "*", $condition);
                if($resultDistrict){
                    $districtID = $resultDistrict[0]["BairroID"];
                    $datas["BairroID"] = $districtID;
                }else{
                    $data = [
                        "BairroNome" => $district,
                        "CidadeID" => $cityID
                    ];
                    Insert("Bairro", $data);

                    $condition = [
                        "BairroNome" => $district,
                        "CidadeID" => $cityID
                    ];
                    $resultDistrict = Read("Bairro", "*", $condition);
                    $districtID = $resultDistrict[0]['BairroID'];
                    $datas["BairroID"] = $districtID;
                }
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
                
                $data = [
                    "BairroNome" => $district,
                    "CidadeID" => $cityID
                ];

                Insert("Bairro", $data);

                $condition = [
                    "BairroNome" => $district,
                    "CidadeID" => $cityID
                ];
                $resultDistrict = Read("Bairro", "*", $condition);
                $districtID = $resultDistrict[0]['BairroID'];
                $datas["BairroID"] = $districtID;
            }
        }
    }
    if ($datas){
        $condition = [
            "ClienteID" => $id
        ];
        if(Update("Cliente", $datas, $condition)){
            $return["code"] = "1";
            $return["message"] = "Cliente atualizado com Sucesso!";
        }
    }else{
        $return["code"] = "0";
        $return["message"] = "Todos os campos vazios!";
    }    
}

    echo json_encode($return);