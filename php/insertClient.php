<?php    
    require __DIR__ . "/../admin/crud.php";

    $name = $_POST['name'];
    $cpf = $_POST['cpf'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $district = $_POST['district'];

    if($name == ""){
        $return["code"] = "0";
        $return["message"] = "Nome não pode ser vazio";
    }elseif($cpf == ""){
        $return["code"] = "0";
        $return["message"] = "CPF não pode ser vazio";
    }elseif($date == ""){
        $return["code"] = "0";
        $return["message"] = "Data de Nascimento não pode ser vazio";
    }elseif(!$_FILES){
        $return["code"] = "0";
        $return["message"] = "Deve conter um arquivo de Foto";
    }elseif($state == ""){
        $return["code"] = "0";
        $return["message"] = "Estado não pode ser vazio";
    }elseif($city == ""){
        $return["code"] = "0";
        $return["message"] = "Cidade não pode ser vazio";
    }elseif($district == ""){
        $return["code"] = "0";
        $return["message"] = "Bairro não pode ser vazio";
    }else{
        
        $photoName = $_FILES['photo']['name'];

        $condition = [
            "CidadeNome" => $city
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
            }
        }else{        
            $data = [
                "CidadeNome" => $city,
                "CidadeUF" => $state
            ];
            Insert("Cidade", $data);

            $condition = [
                "CidadeNome" => $city
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
        }


        $data = [
            "ClienteNome" => $name,
            "ClienteCPF" => $cpf,
            "ClienteDataNasc" => $date,
            "ClienteSexo" => $gender,
            "ClienteFoto" => $photoName,
            "ClienteAtivo" => true,
            "BairroID" => $districtID
        ];
        if(Insert("Cliente", $data)){
            $return["code"] = "1";
            $return["message"] = "Cliente cadastrado com sucesso!";
        }
    }
    echo json_encode($return);
?>
