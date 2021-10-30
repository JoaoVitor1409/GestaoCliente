<?php
    include __DIR__ . "/../php/loginVerify.php";

    $id = $_POST['id'];
    $action = $_POST['action'];

    if($action == 'updateEmployee'){?>
        <!DOCTYPE html>
        <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Comfortaa:wght@500&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="../css/forms.css">
                <title>Atualização de Funcionários</title>
            </head>
            <body>
                <form class="employeeFormUp" action="../php/updateEmployee.php" method="POST">
                    <div class="result"></div>
                    <input type="hidden" name="id" value="<?=$id?>">  

                    <label for="name"><span>Nome:</span>
                    <input type="text" name="name" placeholder="Insira o Nome" id="name">
                    </label>

                    <label for="username"><span>Usuário:</span>
                    <input type="text" name="username" placeholder="Insira o Nome" id="username" >
                    </label>

                    <label for="ps"><span>Senha:</span>
                    <input type="password" name="ps" placeholder="Insira a sua senha" id="ps" >
                    </label>

                    <label for="state"><span>Estado:</span>
                    <select name="state">
                        <option value="NA">Não alterar</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MT">MT</option>
                        <option value="MS">MS</option>
                        <option value="MG">MG</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PR">PR</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SP">SP</option>
                        <option value="SE">SE</option>
                        <option value="TO">TO</option>
                    </select>   
                    </label>

                    <label for="city"><span>Cidade:</span>
                    <input type="text" name="city" placeholder="Insira a Cidade" id="city">
                    </label>

                    <label for="district"><span>Bairro:</span>
                    <input type="text" name="district" placeholder="Insira o Bairro" id="district">        
                    </label>

                    <input type="submit" value="Atualizar" class="btnSubmit">
                </form>

                <script src="../js/jquery-3.6.0.min.js"></script>
                <script src="../js/principal.js"></script>
            </body>
        </html>
    <?php 
    }elseif($action == 'updateClient'){?>
        <!DOCTYPE html>
        <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Comfortaa:wght@500&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="../css/forms.css">
                <title>Atualização de Clientes</title>
            </head>
            <body>
                <form class="clientFormUp" action="../php/updateClient.php" method="POST">
                    <div class="result"></div>
                    <input type="hidden" name="id" value="<?=$id?>"> 

                    <label for="name"><span>Nome:</span>
                    <input type="text" name="name" placeholder="Insira o Nome" id="name">
                    </label>

                    <label for="state"><span>Estado:</span>
                    <select name="state">
                        <option value="NA">Não alterar</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MT">MT</option>
                        <option value="MS">MS</option>
                        <option value="MG">MG</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PR">PR</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SP">SP</option>
                        <option value="SE">SE</option>
                        <option value="TO">TO</option>
                    </select>   
                    </label>

                    <label for="city"><span>Cidade:</span>
                    <input type="text" name="city" placeholder="Insira a Cidade" id="city">
                    </label>

                    <label for="district"><span>Bairro:</span>
                    <input type="text" name="district" placeholder="Insira o Bairro" id="district">        
                    </label>

                    <input type="submit" value="Atualizar" class="btnSubmit">
                </form>

                <script src="../js/jquery-3.6.0.min.js"></script>
                <script src="../js/principal.js"></script>
            </body>
        </html>
    <?php 
    }elseif($action == 'updateDistrict'){?>
        <!DOCTYPE html>
        <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Comfortaa:wght@500&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="../css/forms.css">
                <title>Atualização de Bairros</title>
            </head>
            <body>
                <form class="districtFormUp" action="../php/updateDistrict.php" method="POST">
                    <div class="result"></div>
                    <input type="hidden" name="id" value="<?=$id?>"> 

                    <label for="name"><span>Nome: </span>
                    <input type="text" name="name" placeholder="Insira o Nome" id="name">
                    </label>

                    <label for="state"><span>Estado:</span>
                    <select name="state">
                        <option value="NA">Não alterar</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MT">MT</option>
                        <option value="MS">MS</option>
                        <option value="MG">MG</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PR">PR</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SP">SP</option>
                        <option value="SE">SE</option>
                        <option value="TO">TO</option>
                    </select>       
                    </label>

                    <label for="city"><span>Cidade:</span>
                    <input type="text" name="city" placeholder="Insira a Cidade" id="city">        
                    </label>

                    <input type="submit" value="Atualizar" class="btnSubmit">
                </form>

                <script src="../js/jquery-3.6.0.min.js"></script>
                <script src="../js/principal.js"></script>
            </body>
        </html>
    <?php 
    }elseif($action == 'updateCity'){?>
        <!DOCTYPE html>
        <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Comfortaa:wght@500&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="../css/forms.css">
                <title>Atualização de Cidades</title>
            </head>
            <body>
                <form class="cityFormUp" action="../php/updateCity.php" method="POST">
                    <div class="result"></div>
                    <input type="hidden" name="id" value="<?=$id?>">   

                    <label for="name"><span>Nome: </span>
                    <input type="text" name="name" placeholder="Insira o Nome" id="name">
                    </label>

                    <label for="state"><span>Estado: </span>
                    <select name="state">
                        <option value="NA">Não alterar</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MT">MT</option>
                        <option value="MS">MS</option>
                        <option value="MG">MG</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PR">PR</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SP">SP</option>
                        <option value="SE">SE</option>
                        <option value="TO">TO</option>
                    </select>                               
                    </label>

                    <input type="submit" value="Atualizar" class="btnSubmit">
                </form>

                <script src="../js/jquery-3.6.0.min.js"></script>
                <script src="../js/principal.js"></script>
            </body>
        </html>
    <?php
    }elseif($action == 'updateModule'){?>
        <!DOCTYPE html>
        <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Comfortaa:wght@500&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="../css/forms.css">
                <title>Atualização de Módulos</title>
            </head>
            <body>
                <form class="moduleFormUp" action="../php/updateModule.php" method="POST">
                    <div class="result"></div>
                    <input type="hidden" name="id" value="<?=$id?>">   

                    <label for="name"><span>Nome:</span>
                    <input type="text" name="name" placeholder="Insira o Nome" id="name">          
                    </label>
                    <input type="submit" value="Atualizar" class="btnSubmit">
                </form>

                <script src="../js/jquery-3.6.0.min.js"></script>
                <script src="../js/principal.js"></script>
            </body>
        </html>
    <?php }