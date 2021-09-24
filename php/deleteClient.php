<?php

    require __DIR__ . "/../admin/crud.php";
    $id = $_POST['id'];

    if(!$id){
        $return["code"] = 0;
        $return["mensagem"] = "ID não pode ser vazio";
    }else{
        if(Delete("Cliente", $id)){
            $return["code"] = 1;
            $return["message"] = "Cliente removido com sucesso!";
        }
    }
    echo json_encode($return);