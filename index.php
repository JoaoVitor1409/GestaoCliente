<?php
    session_start();
    $on = isset($_SESSION['login']) ? true : false;
    if(!$on){
        header("Location: forms/login.php");
    }
    $signup = @$_SESSION['user']['modules']['signup'];
    $read = @$_SESSION['user']['modules']['read'];
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/icones.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@    &display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <title>Página Principal</title>
    </head>
    <body>    
        <div class="header">
            <?php if($on){?>
            <img src="photos/<?= $_SESSION['user']['photo'] ?>" alt="Foto do Funcionário">
            <h1>Bem vindo <?=$_SESSION['user']['username']?></h1>            
            <?php }?>
            <?php if($on){?>
            <a href="php/logout.php">Sair da sessão</a>
            <?php }?>
        </div>

        <div id="container">
            
            <?php if($read){?>
            <div class="employee">
            
                <h1>Lista de Funcionarios:</h1>

                <form class="employeeForm" action="php/readEmployee.php" method="POST">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="Buscar Funcionario" name="employee">
                    <button type="submit" class="btnSearchEmp"><span class="fas fa-search"></span></button>
                </form>
            
                <div id="readEmployee"></div>
            </div>
            <?php }?>
            <?php if($signup){?>
                <a href="forms/signupEmployee.php" class="btn">Inserir Funcionario</a>
            <?php }?>
            

            
            <?php if($read){?>
            <div class="client">
                <h1>Lista de Clientes:</h1>

                <form class="clientForm" action="php/readClient.php" method="POST">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="Buscar Cliente" name="client">
                    <button type="submit" class="btnSearchCli"><span class="fas fa-search"></span></button>
                </form>

                <div id="readClient"></div>
            </div>
            <?php }?>
            <?php if($signup){?>
                <a href="forms/signupClient.php" class="btn">Inserir Cliente</a>
            <?php }?>           
            

            <?php if($read){?>
            <div class="module">
                <h1>Lista de Módulos:</h1>

                <form class="moduleForm" action="php/readModule.php" method="POST">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="Buscar Módulo" name="module">
                    <button type="submit" class="btnSearchMod"><span class="fas fa-search"></span></button>
                </form>

                <div id="readModule"></div>
            </div>
            <?php }?>
            <?php if($signup){?>
                <a href="forms/signupModule.php" class="btn">Inserir Módulo</a>
            <?php }?>
            


            <?php if($read){?>
            <div class="district">
                <h1>Lista de Bairros:</h1>

                <form class="districtForm" action="php/readDistrict.php" method="POST">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="Buscar Bairro" name="district">
                    <button type="submit" class="btnSearchDis"><span class="fas fa-search"></span></button>
                </form>

                <div id="readDistrict"></div>
            </div>
            <?php }?>
            <?php if($signup){?>
                <a href="forms/signupDistrict.php" class="btn">Inserir Bairro</a>
            <?php }?>
           

            <?php if($read){?>
            <div class="city">
                <h1>Lista de Cidades:</h1>

                <form class="cityForm" action="php/readCity.php" method="POST">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="Buscar Cidade" name="city">
                    <button type="submit" class="btnSearchCity"><span class="fas fa-search"></span></button>
                </form>

                <div id="readCity"></div>
            </div>
            <?php }?>
            <?php if($signup){?>
                <a href="forms/signupCity.php" class="btn">Inserir Cidade</a>
            <?php }?>
        </div>
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/sweetalert2.js"></script>
        <script src="js/read.js"></script>
    </body>
</html>
