<?php

    require __DIR__ . "/../admin/crud.php";

    switch ($_POST['action']) {
        case 'insertDistrict':
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
        break;
        
        case 'insertCity':
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
        break;

        case 'insertClient':
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
        break;

        case 'deleteClient':
            $id = $_POST['id'];

            if(!$id){
                $return["code"] = 0;
                $return["message"] = "ID não pode ser vazio";
            }else{
                if(Delete("Cliente", $id)){
                    $return["code"] = 1;
                    $return["message"] = "Cliente removido com sucesso!";
                }
            }
            echo json_encode($return);
        break;

        case 'updateDistrict':
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
        break;

        case 'updateCity':
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
        break;

        case 'updateClient':
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
        break;

        default:
            $return["code"] = "0";
            $return["message"] = "Nenhuma ação definida. Contate o suporte!";
            echo json_encode($return);
        break;
    }