<?php
    session_start();
    $valor = isset($_SESSION['login']) ? true : false;
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
            <?php if($valor){?>
            <h1>Bem vindo <?=$_SESSION['user']['username']?></h1>
            <?php }?>
            <a href="forms/login.php">Login</a>
            <a href="php/logout.php">Logout</a>            
        </div>

        <?php if($valor){?>

        <div class="employee">
            <h1>Funcionarios:</h1>

            <form class="employeeForm" action="php/readEmployee.php" method="POST">
                <input type="text" placeholder="Buscar Funcionario" name="employee">
                <input type="submit" value="Buscar" class="btnSearchEmp">
            </form>

            <div id="readEmployee"></div>

            <a href="forms/signupEmployee.php">Inserir Funcionario</a>
        </div>

        <?php }?>
        
        <div class="client">
            <h1>Clientes:</h1>

            <form class="clientForm" action="php/readClient.php" method="POST">
                <input type="text" placeholder="Buscar Cliente" name="client">
                <input type="submit" value="Buscar" class="btnSearchCli">
            </form>

            <div id="readClient"></div>

            <a href="forms/signupClient.php">Inserir Cliente</a>            
        </div>
        <div class="district">
            <h1>Bairros:</h1>

            <form class="districtForm" action="php/readDistrict.php" method="POST">
                <input type="text" placeholder="Buscar Bairro" name="district">
                <input type="submit" value="Buscar" class="btnSearchDis">
            </form>

            <div id="readDistrict"></div>

            <a href="forms/signupDistrict.php">Inserir Bairro</a>
        </div>
        <div class="city">
            <h1>Cidades:</h1>

            <form class="cityForm" action="php/readCity.php" method="POST">
                <input type="text" placeholder="Buscar Cidade" name="city">
                <input type="submit" value="Buscar" class="btnSearchCity">
            </form>

            <div id="readCity"></div>

            <a href="forms/signupCity.php">Inserir uma nova Cidade</a>
        </div>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/sweetalert2.js"></script>
        <script src="js/read.js"></script>
    </body>
</html>
