<?php

    require __DIR__ . "/../admin/crud.php";

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
        foreach($result as $item){
            $condition = [
                "CidadeID" => $item['CidadeID']
            ];
            $city = Read("Cidade", "CidadeNome", $condition);

            echo "<p>". $item['BairroID'] ."º Bairro {
            <br> Nome: ". $item['BairroNome'] .
            "<br> Cidade: " . $city[0]["CidadeNome"] .             
            "<br>}</p>";
        }
    }
    else{
        echo "Não há nenhum Bairro cadastrado!";
    }