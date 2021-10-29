<?php

    require __DIR__ . "/connection.php";

    function Insert($table, array $data){
        FixCodeSql($data);
        $rows = implode(",", array_keys($data));
        $values = "'" . implode("','", $data) . "'";
        $sql = "INSERT INTO {$table}({$rows}) values({$values});";

        $result = Execute($sql);
        if($result == 1){
            return true;
        }else{
            return $result;
        }
    }

    function Read($table, $fields = "*", array $condition = null, $like = false, $logiOper = null){
        if($condition){
            foreach($condition as $key => $value){
                if($like){
                    $conditions[] = " {$key} LIKE '%{$value}%' ";
                }else{
                    $conditions[] = " {$key} = '{$value}' ";
                }                
            }

            if(count($conditions) > 1 && !$logiOper){
                $logiOper = "&&";
            }elseif($logiOper == "and"){
                $logiOper = "&&";
            }elseif($logiOper == "our"){
                $logiOper = "||";
            }

            $conditions = implode($logiOper, $conditions);
            
            
            $condition_phrase = "WHERE {$conditions}";
            
            
        }else{
            $condition_phrase = null;
        }
        
        $sql = "SELECT {$fields} from {$table} {$condition_phrase};";

        $result = Execute($sql);
        if(mysqli_num_rows($result)){
            while($record = mysqli_fetch_assoc($result)){
                $data[] = $record;
            }
            return $data;
        }else{
            return false;
        }
    }

    function Update($table, array $data, array $condition = null, $logiOper = null){
        FixCodeSql($data);
        if($condition){
            foreach($condition as $key => $value){
                $conditions[] = " {$key} = '{$value}' ";
            }

            if(count($conditions) > 1 && !$logiOper){
                $logiOper = "&&";
            }elseif($logiOper == "and"){
                $logiOper = "&&";
            }elseif($logiOper == "our"){
                $logiOper = "||";
            }

            $conditions = implode($logiOper, $conditions);

            $condition_phrase = "WHERE {$conditions}";
        }else{
            $condition_phrase = null;
        }

        foreach($data as $key => $value){
            $fields[] = "{$key} = '{$value}'"; 
        }
        $fields = implode(",", $fields);

        $sql = "UPDATE {$table} set {$fields} {$condition_phrase};";
        $result = Execute($sql);
        if($result == 1){
            return true;
        }else{
            return $result;
        }
    }

    function Delete($table, array $condition, $logiOper = null){                
        if($condition){
            foreach($condition as $key => $value){
                $conditions[] = " {$key} = '{$value}' ";
            }

            if(count($conditions) > 1 && !$logiOper){
                $logiOper = "&&";
            }elseif($logiOper == "and"){
                $logiOper = "&&";
            }elseif($logiOper == "our"){
                $logiOper = "||";
            }

            $conditions = implode($logiOper, $conditions);

            $condition_phrase = "WHERE {$conditions}";
        }else{
            $condition_phrase = null;
        }
        
        $sql = "Delete from {$table} {$condition_phrase}";
        $result = Execute($sql);

        if($result == 1){
            return true;
        }else{
            return $result;
        }
    }

    function Execute($sql){
        $mysqli =  OpenConnection();
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

        return $result;
    }