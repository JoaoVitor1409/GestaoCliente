<?php

    require __DIR__ . "/../admin/crud.php";

    $city = $_POST["city"];
    if(!$city){
        $result = Read("Cidade");
    }else{
        $condition = [
            "CidadeNome" => $city
        ];
        $result = Read("Cidade", "CidadeID, CidadeNome, CidadeUF", $condition, true);   
    }
    if($result){
        foreach($result as $item){
            echo "<p>". $item['CidadeID'] ."º Cidade {
            <br> Nome: ". $item['CidadeNome'] .
            "<br> Estado: " . $item['CidadeUF'] .             
            "<br>}</p>";
        }
    }
    else{
        echo "Não há nenhuma Cidade cadastrada!";
    }