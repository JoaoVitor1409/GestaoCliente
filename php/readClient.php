<?php

    require __DIR__ . "/../admin/crud.php";

    $client = $_POST["client"];
    if(!$client){
        $condition = [
            "ClienteAtivo" => 1
        ];
        $result = Read("Cliente", "*", $condition, false);
    }else{
        $condition = [
            "ClienteNome" => $client,
            "ClienteAtivo" => 1
        ];
        $result = Read("Cliente", "ClienteID, ClienteNome, ClienteCPF, ClienteDataNasc, ClienteSexo, ClienteFoto, ClienteAtivo ,BairroID", $condition, true, "and");   
    }
    if($result){
        foreach($result as $item){
            $condition = [
                "BairroID" => $item['BairroID']
            ];
            $district = Read("Bairro", "CidadeID, BairroNome", $condition);
            $condition = [
                "CidadeID" => $district[0]["CidadeID"]
            ];
            $city = Read("Cidade", "CidadeNome", $condition);

            echo "<p>". $item['ClienteID'] ."º Cliente {
            <br> Nome: ". $item['ClienteNome'] .
            "<br> CPF: " . $item['ClienteCPF'] . 
            "<br> Data de Nascimento: " . $item['ClienteDataNasc'] . 
            "<br> Sexo: " . $item['ClienteSexo'] . 
            "<br> Foto: " . $item['ClienteFoto'] .                 
            "<br> Bairro: " . $district[0]['BairroNome'] .                 
            "<br> Cidade: " . $city[0]['CidadeNome'] .
            "<br>}</p>";
        }
    }
    else{
        echo "Não há nenhum Cliente cadastrado!";
    }
