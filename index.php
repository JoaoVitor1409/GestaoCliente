<?php
    session_start();
    $on = isset($_SESSION['login']) ? true : false;
    $signup = isset($_SESSION['user']['modules'][0]) ? true : false;
    $read = isset($_SESSION['user']['modules'][1]) ? true : false;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/icones.js"></script>
        <title>Página Principal</title>
    </head>
    <body>    
        <div class="header">
            <?php if($on){?>
            <h1>Bem vindo <?=$_SESSION['user']['username']?></h1>
            <?php }?>
            <a href="forms/login.php">Login</a>
            <a href="php/logout.php">Logout</a>            
        </div>

        <?php if($read){?>
        <div class="module">
            <h1>Módulos:</h1>

            <form class="moduleForm" action="php/readModule.php" method="POST">
                <input type="text" placeholder="Buscar Módulo" name="module">
                <input type="submit" value="Buscar" class="btnSearchMod">
            </form>

            <div id="readModule"></div>
        <?php }?>
        <?php if($signup){?>
            <a href="forms/signupModule.php">Inserir Módulo</a>
        <?php }?>
        </div>

        <?php if($read){?>
        <div class="employee">
        
            <h1>Funcionarios:</h1>

            <form class="employeeForm" action="php/readEmployee.php" method="POST">
                <input type="text" placeholder="Buscar Funcionario" name="employee">
                <input type="submit" value="Buscar" class="btnSearchEmp">
            </form>
        
            <div id="readEmployee"></div>
        <?php }?>
        <?php if($signup){?>
            <a href="forms/signupEmployee.php">Inserir Funcionario</a>
        <?php }?>
        </div>

        
        <?php if($read){?>
        <div class="client">
            <h1>Clientes:</h1>

            <form class="clientForm" action="php/readClient.php" method="POST">
                <input type="text" placeholder="Buscar Cliente" name="client">
                <input type="submit" value="Buscar" class="btnSearchCli">
            </form>

            <div id="readClient"></div>
        <?php }?>
        <?php if($signup){?>
            <a href="forms/signupClient.php">Inserir Cliente</a>
        <?php }?>           
        </div>

        <?php if($read){?>
        <div class="district">
            <h1>Bairros:</h1>

            <form class="districtForm" action="php/readDistrict.php" method="POST">
                <input type="text" placeholder="Buscar Bairro" name="district">
                <input type="submit" value="Buscar" class="btnSearchDis">
            </form>

            <div id="readDistrict"></div>
        <?php }?>
        <?php if($signup){?>
            <a href="forms/signupDistrict.php">Inserir Bairro</a>
        <?php }?>
        </div>

        <?php if($read){?>
        <div class="city">
            <h1>Cidades:</h1>

            <form class="cityForm" action="php/readCity.php" method="POST">
                <input type="text" placeholder="Buscar Cidade" name="city">
                <input type="submit" value="Buscar" class="btnSearchCity">
            </form>

            <div id="readCity"></div>
        <?php }?>
        <?php if($signup){?>
            <a href="forms/signupCity.php">Inserir uma nova Cidade</a>
        <?php }?>
        </div>
        <?php
        if(!$on || (!$signup && !$read)){?>
            <h1>Você não está logado ou não tem permissão no sistema!</h1>
        <?php }?>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/sweetalert2.js"></script>
        <script src="js/read.js"></script>
    </body>
</html>
