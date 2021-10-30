<?php

    session_start();

    require __DIR__ . "/../admin/crud.php";

    switch ($_POST['action']) {

        case 'readEmployee':
            $employee = $_POST['employee'];            
            if($employee){
                $condition = [
                    "FuncionarioNome" => $employee,
                    "FuncionarioAtivo" => 1
                ];
                $result = Read("Funcionario", "FuncionarioID, FuncionarioUsuario, FuncionarioNome, FuncionarioCPF, FuncionarioDataNasc, FuncionarioSexo, BairroID", $condition, true); 
            }else{
                $condition = [
                    "FuncionarioAtivo" => 1
                ];
                $result = Read("Funcionario", "FuncionarioID, FuncionarioUsuario, FuncionarioNome, FuncionarioCPF, FuncionarioDataNasc, FuncionarioSexo, BairroID", $condition);
            }
            if($result){
                for ($i=0; $i < sizeof($result); $i++) { 
                    $condition = [
                        "BairroID" => $result[$i]['BairroID']
                    ];
                    $district = Read("Bairro", "CidadeID, BairroNome", $condition);
                    $condition = [
                        "CidadeID" => $district[0]["CidadeID"]
                    ];
                    $city = Read("Cidade", "CidadeNome", $condition);
    
                    $result[$i]['BairroNome'] = $district[0]['BairroNome'];
                    $result[$i]['CidadeNome'] = $city[0]['CidadeNome'];
                }
            }           
            echo json_encode($result);
        break;

        case 'readClient':
            $client = $_POST['client'];            
            if($client){
                $condition = [
                    "ClienteNome" => $client,
                    "ClienteAtivo" => 1
                ];
                $result = Read("Cliente", "ClienteID, ClienteNome, ClienteCPF, ClienteDataNasc, ClienteSexo, BairroID", $condition, true, "and"); 
            }else{
                $condition = [
                    "ClienteAtivo" => 1
                ];
                $result = Read("Cliente", "ClienteID, ClienteNome, ClienteCPF, ClienteDataNasc, ClienteSexo, BairroID", $condition);
            }
            if($result){
                for ($i=0; $i < sizeof($result); $i++) { 
                    $condition = [
                        "BairroID" => $result[$i]['BairroID']
                    ];
                    $district = Read("Bairro", "CidadeID, BairroNome", $condition);
                    $condition = [
                        "CidadeID" => $district[0]["CidadeID"]
                    ];
                    $city = Read("Cidade", "CidadeNome", $condition);
    
                    $result[$i]['BairroNome'] = $district[0]['BairroNome'];
                    $result[$i]['CidadeNome'] = $city[0]['CidadeNome'];
                }
            }
            
            echo json_encode($result);

        break;

        case 'readDistrict':
            $district = $_POST["district"];
            if(!$district){
               $result = Read("Bairro");
            }else{
                $condition = [
                    "BairroNome" => $district
                ];
                $result = Read("Bairro", "BairroID, BairroNome, CidadeID", $condition, true);    
            }
            if($result){
                for ($i=0; $i < sizeof($result); $i++) { 
                    $condition = [
                        "CidadeID" => $result[$i]["CidadeID"]
                    ];
                    $city = Read("Cidade", "CidadeNome", $condition);
                    
                    $result[$i]['CidadeNome'] = $city[0]['CidadeNome'];
                }
            }
            echo json_encode($result);
        break;

        case 'readCity':
            $city = $_POST["city"];
            if(!$city){
               $result = Read("Cidade");
            }else{
                $condition = [
                    "CidadeNome" => $city
                ];
                $result = Read("Cidade", "CidadeID, CidadeNome, CidadeUF", $condition, true);          
            }
            echo json_encode($result);
        break;

        case 'readModule':
            $module = $_POST["module"];

            if(!$module){
               $result = Read("Modulo");
            }else{
                $condition = [
                    "ModuloNome" => $module
                ];
                $result = Read("Modulo", "*", $condition, true);          
            }
            echo json_encode($result);
        break;

        case 'insertEmployee':
            $name = $_POST['name'];
            $username = $_POST['username'];
            $ps = $_POST['ps'];
            $cpf = $_POST['cpf'];
            $date = $_POST['date'];
            $gender = $_POST['gender'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $district = $_POST['district'];
            $module = $_POST['module'];

            if($name == ""){
                $return["code"] = "0";
                $return["message"] = "Nome não pode ser vazio";
            }elseif($username == ""){
                $return["code"] = "0";
                $return["message"] = "Usuário não pode ser vazio";
            }elseif($ps == ""){
                $return["code"] = "0";
                $return["message"] = "Senha não pode ser vazia";
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
            }elseif($module == "NA" &&(isset($_POST['module2']) || isset($_POST['module3']) || isset($_POST['module4']))){
                $return["code"] = "0";
                $return["message"] = 'Não poderá conter nenhum módulo, já que foi selecionado a opção "Nenhum Módulo"';
            }else{
                $city = mb_convert_case($city, MB_CASE_LOWER);
                $district = mb_convert_case($district, MB_CASE_LOWER);
                $city = ucfirst($city);
                $district = ucfirst($district);

                $photoName = $_FILES['photo']['name'];

                $file = '../photos/';
                if(!file_exists($file)){
                    mkdir($file, 0775);
                }

                $photoEx = strchr($photoName, ".");
                $imgEx = ['.jpg', '.jpeg', '.png', '.gif'];

                if(in_array($photoEx, $imgEx)){
                    if(!move_uploaded_file($_FILES['photo']['tmp_name'], $file . $photoName)){
                        $return["code"] = "0";
                        $return["message"] = 'Imagem não enviada, por favor contate o suporte!';
                        echo json_encode($return);
                        return;
                    }
                }else{
                    $return["code"] = "0";
                    $return["message"] = 'Imagem não suportada';
                    echo json_encode($return);
                    return;
                }

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

                if(mb_strlen($cpf) != 14){
                    $return["code"] = "0";
                    $return["message"] = 'CPF Inválido';
                    echo json_encode($return);
                    return;
                }
                $dataEmp = [
                    "FuncionarioNome" => $name,
                    "FuncionarioUsuario" => $username,
                    "FuncionarioSenha" => $ps,
                    "FuncionarioCPF" => $cpf,
                    "FuncionarioDataNasc" => $date,
                    "FuncionarioSexo" => $gender,
                    "FuncionarioFoto" => $photoName,
                    "FuncionarioAtivo" => true,
                    "BairroID" => $districtID
                ];
                


                if($module != "NA"){          
                    $modules = [$module];
                    if(isset($_POST['module2'])){
                        $modules[] = $_POST['module2'];
                    }
                    if(isset($_POST['module3'])){
                        $modules[] = $_POST['module3'];
                    }
                    if(isset($_POST['module4'])){
                        $modules[] = $_POST['module4'];                        
                    }
                    if(count($modules) != 1){
                                            
                        for ($i=0; $i < count($modules)-1; $i++) { 
                            for ($j=$i+1; $j < count($modules); $j++) { 
                                if($modules[$i] == $modules[$j]){
                                    $return["code"] = "0";
                                    $return["message"] = 'Não deve conter nenhum módulo igual'; 
                                                       
                                    echo json_encode($return);
                                    return;
                                }
                            }
                        }
                    }                    
                    Insert("Funcionario", $dataEmp);

                    $condition = [
                        "FuncionarioCPF" => $cpf
                    ];
                    $id = Read("Funcionario", "FuncionarioID", $condition);


                    $dataMod["module"] = [
                        "ModuloID" => $module,
                        "FuncionarioID" => $id[0]["FuncionarioID"]
                    ];
                    Insert("FuncionarioModulo", $dataMod['module']);

                    if(isset($_POST['module2'])){                        
                        $dataMod["module2"] = [
                            "ModuloID" => $_POST['module2'],
                            "FuncionarioID" => $id[0]["FuncionarioID"]
                        ];
                        Insert("FuncionarioModulo", $dataMod['module2']);
                    }
                    if(isset($_POST['module3'])){
                        $dataMod["module3"] = [
                            "ModuloID" => $_POST['module3'],
                            "FuncionarioID" => $id[0]["FuncionarioID"]
                        ];
                        Insert("FuncionarioModulo", $dataMod['module3']);
                    }
                    if(isset($_POST['module4'])){
                        $dataMod["module4"] = [
                            "ModuloID" => $_POST['module4'],
                            "FuncionarioID" => $id[0]["FuncionarioID"]
                        ];
                        Insert("FuncionarioModulo", $dataMod['module4']);                      
                    }
                }else{
                    Insert("Funcionario", $dataEmp);
                }

                $return["code"] = "1";
                $return["message"] = "Funcionário cadastrado com sucesso!";

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
                
                $city = mb_convert_case($city, MB_CASE_LOWER);
                $district = mb_convert_case($district, MB_CASE_LOWER);
                $city = ucfirst($city);
                $district = ucfirst($district);

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

                if(mb_strlen($cpf) != 14){
                    $return["code"] = "0";
                    $return["message"] = 'CPF Inválido';
                    echo json_encode($return);
                    return;
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

        case 'insertDistrict':
            $name = $_POST['name'];
            $state = $_POST['state'];
            $city = $_POST['city'];

            if($name == ""){
                $return["code"] = "0";
                $return["message"] = "Nome não pode ser vazio";
            }elseif($city == ""){
                $return["code"] = "0";
                $return["message"] = "Cidade não pode ser vazio";
            }else{
                $city = mb_convert_case($city, MB_CASE_LOWER);
                $name = mb_convert_case($name, MB_CASE_LOWER);
                $city = ucfirst($city);
                $name = ucfirst($name);
            
                $condition = [
                    "CidadeNome" => $city,
                    "CidadeUF" => $state
                ];
                $resultCity = Read("Cidade", "*", $condition);
                if($resultCity){
                    $cityId = $resultCity[0]['CidadeID'];
                }else{
                    $data = [
                        "CidadeNome" => $city,
                        "CidadeUF" => $state
                    ];
                    Insert("Cidade", $data)
                    ;$resultCity = Read("Cidade", "*", $condition);
                    $cityId = $resultCity[0]['CidadeID'];
                }
                $data = [
                    "BairroNome" => $name,
                    "CidadeID" => $cityId
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
                    "CidadeNome" => ucfirst(mb_convert_case($name, MB_CASE_LOWER)),
                    "CidadeUF" => $state
                ];
                if(Insert("Cidade",$data)){
                    $return["code"] = "1";
                    $return["message"] = "Cidade cadastrada com sucesso!";
                }
            }
            echo json_encode($return);
        break;        

        case 'insertModule':
            $name = $_POST['name'];

            if($name == ""){
                $return["code"] = "0";
                $return["message"] = "Nome não pode ser vazio";
            }else{
                $data = [
                    "ModuloNome" => $name
                ];
                if(Insert("Modulo", $data)){
                    $return["code"] = "1";
                    $return["message"] = "Módulo cadastrado com sucesso!";
                }
            }
            echo json_encode($return);
        break;

        case 'updateEmployee':
            $id = $_POST['id'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $ps = $_POST['ps'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $district = $_POST['district'];

            if($id == ""){
                $return["code"] = "0";
                $return["message"] = "ID do funcionário não pode ser vazio";
            }else{
                $datas = [];
        
                if($name != ""){
                    $datas["FuncionarioNome"] = $name;
                }
                if($username != ""){
                    $datas["FuncionarioUsuario"] = $username;
                }
                if($ps != ""){
                    $datas["FuncionarioSenha"] = $ps;
                }
                if($state != "NA"){
                    $city = mb_convert_case($city, MB_CASE_LOWER);
                    $district = mb_convert_case($district, MB_CASE_LOWER);
                    $city = ucfirst($city);
                    $district = ucfirst($district);
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
                        "FuncionarioID" => $id
                    ];
                    if(Update("Funcionario", $datas, $condition)){
                        $return["code"] = "1";
                        $return["message"] = "Funcionário atualizado com Sucesso!";
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
                if($state != "NA"){
                    $city = mb_convert_case($city, MB_CASE_LOWER);
                    $district = mb_convert_case($district, MB_CASE_LOWER);
                    $city = ucfirst($city);
                    $district = ucfirst($district);
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
                if($state != "NA"){
                    $city = mb_convert_case($city, MB_CASE_LOWER);
                    $name = mb_convert_case($name, MB_CASE_LOWER);
                    $city = ucfirst($city);
                    $name = ucfirst($name);
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
                    $datas["CidadeNome"] = ucfirst(mb_convert_case($name, MB_CASE_LOWER));
                }
                if($state != "NA"){
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

        case 'updateModule':
            $id = $_POST['id'];
            $name = $_POST['name'];

            if($id == ""){
                $return["code"] = "0";
                $return["message"] = "ID não pode ser vazio";
            }elseif($name == ""){
                $return["code"] = "0";
                $return["message"] = "Nome não pode ser vazio";
            }else{
                $data["ModuloNome"] = $name;
                
                $condition = [
                    "ModuloID" => $id
                ];
                if(Update("Modulo", $data, $condition)){
                    $return["code"] = "1";
                    $return["message"] = "Módulo atualizado com Sucesso!";
                }
            }

            echo json_encode($return);
        break;

        case 'deleteEmployee':
            $data = [
                "FuncionarioAtivo" => 0
            ];
            $condition = [
                "FuncionarioID" => $_POST['id']
            ];
            if(Update("Funcionario", $data, $condition)){
                    $return["code"] = 1;
                    $return["message"] = "Funcionário removido com sucesso!";
                    if($_POST['id'] == $_SESSION['user']['id']){
                        $return['logout'] = true;
                    }
            }
            echo json_encode($return);
        break;

        case 'deleteClient':
            $data = [
                "ClienteAtivo" => 0
            ];
            $condition = [
                "ClienteID" => $_POST['id']
            ];
            if(Update("Cliente", $data, $condition)){
                    $return["code"] = 1;
                    $return["message"] = "Cliente removido com sucesso!";
            }
            echo json_encode($return);
        break;

        case 'deleteDistrict':
            $condition = [
                "BairroID" => $_POST['id']
            ];

            if(Delete("Bairro", $condition)){
                    $return["code"] = 1;
                    $return["message"] = "Bairro removido com sucesso!";
            }
            echo json_encode($return);
        break;

        case 'deleteCity':
            $condition = [
                "CidadeID" => $_POST['id']
            ];

            if(Delete("Cidade", $condition)){
                    $return["code"] = 1;
                    $return["message"] = "Cidade removida com sucesso!";
            }
            echo json_encode($return);
        break;

        case 'deleteModule':
            $condition = [
                "ModuloID" => $_POST['id']
            ];

            if(Delete("Modulo", $condition)){
                    $return["code"] = 1;
                    $return["message"] = "Módulo removido com sucesso!";
            }
            echo json_encode($return);
        break;

        case 'login':
            $username = $_POST['username'];
            $ps = $_POST['ps'];

            if(!$username){
                $return['code'] = 0;
                $return['message'] = "Usuario não pode ser vazio!";
            }elseif(!$ps){
                $return['code'] = 0;
                $return['message'] = "Senha não pode ser vazia!";
            }else{
                $condition = [
                    "FuncionarioUsuario" => $username,
                    "FuncionarioSenha" => $ps,
                    "FuncionarioAtivo" => 1
                ];

                $result = Read("Funcionario", "FuncionarioID, FuncionarioUsuario, FuncionarioSenha, FuncionarioFoto", $condition);

                $condition = [
                    "FuncionarioID" => $result[0]["FuncionarioID"]
                ];

                $modules = Read("FuncionarioModulo", "ModuloID", $condition);
                
                if($result){
                    $return['code'] = 1;
                    $return['message'] = "Bem vindo!";

                    $_SESSION['login'] = true;
                    $_SESSION['user'] = [
                        'username' => $username, 
                        'id' => $result[0]['FuncionarioID'],
                        'photo' => $result[0]['FuncionarioFoto'],
                    ];

                    $_SESSION['user']['modules']['signup'] = false;
                    $_SESSION['user']['modules']['read'] = false;

                    if($modules){
                        foreach ($modules as $value) {  
                            $condition = [
                                "ModuloID" => $value['ModuloID']
                            ];
                            $modulesNames[] = Read("Modulo", "ModuloNome", $condition);
                        }                 
                        if(isset($modulesNames[0][0]['ModuloNome'])){
                             if($modulesNames[0][0]['ModuloNome'] == 'Cadastrar'){
                                $_SESSION['user']['modules']['signup'] = true;
                                if(isset($modulesNames[1][0]['ModuloNome'])){
                                    if($modulesNames[1][0]['ModuloNome'] == 'Listar'){
                                        $_SESSION['user']['modules']['read'] = true;
                                    }
                                }                                
                            }else if($modulesNames[0][0]['ModuloNome'] == 'Listar'){
                                $_SESSION['user']['modules']['read'] = true;
                            }
                        }

                    }
                    if(!$_SESSION['user']['modules']['signup'] && !$_SESSION['user']['modules']['read']){
                        $return['code'] = 0;
                        $return['message'] = "Você não tem permissão para entrar no sistema, por favor contate o suporte!";
                    }
                }else{
                    $return['code'] = 0;
                    $return['message'] = "Usuario e/ou senha inválida!";
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