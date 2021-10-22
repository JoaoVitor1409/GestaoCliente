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
                <title>Atualização de Funcionários</title>
            </head>
            <body>
                <div class="result"></div>

                <form class="employeeFormUp" action="../php/updateEmployee.php" method="POST">
                    <input type="hidden" name="id" value="<?=$id?>">  

                    <label for="name">Nome:</label>
                    <input type="text" name="name" placeholder="Insira o Nome" id="name">

                    <label for="username">Usuário:</label>
                    <input type="text" name="username" placeholder="Insira o Nome" id="username" >

                    <label for="ps">Senha:</label>
                    <input type="password" name="ps" placeholder="Insira a sua senha" id="ps" >

                    <label for="state">Estado:</label>
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

                    <label for="city">Cidade:</label>
                    <input type="text" name="city" placeholder="Insira a Cidade" id="city">

                    <label for="district">Bairro:</label>
                    <input type="text" name="district" placeholder="Insira o Bairro" id="district">        

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
                <title>Atualização de Clientes</title>
            </head>
            <body>

                <div class="result"></div>

                <form class="clientFormUp" action="../php/updateClient.php" method="POST">
                    <input type="hidden" name="id" value="<?=$id?>"> 

                    <label for="name">Nome:</label>
                    <input type="text" name="name" placeholder="Insira o Nome" id="name">

                    <label for="state">Estado:</label>
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

                    <label for="city">Cidade:</label>
                    <input type="text" name="city" placeholder="Insira a Cidade" id="city">

                    <label for="district">Bairro:</label>
                    <input type="text" name="district" placeholder="Insira o Bairro" id="district">        

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
                <title>Atualização de Bairros</title>
            </head>
            <body>

                <div class="result"></div>

                <form class="districtFormUp" action="../php/updateDistrict.php" method="POST">
                    <input type="hidden" name="id" value="<?=$id?>"> 

                    <label for="name">Nome:</label>
                    <input type="text" name="name" placeholder="Insira o Nome" id="name">

                    <label for="state">Estado:</label>
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

                    <label for="city">Cidade:</label>
                    <input type="text" name="city" placeholder="Insira a Cidade" id="city">        

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
                <title>Atualização de Cidades</title>
            </head>
            <body>

                <div class="result"></div>

                <form class="cityFormUp" action="../php/updateCity.php" method="POST">
                    <input type="hidden" name="id" value="<?=$id?>">   

                    <label for="name">Nome:</label>
                    <input type="text" name="name" placeholder="Insira o Nome" id="name">

                    <label for="state">Estado:</label>
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
                <title>Atualização de Módulos</title>
            </head>
            <body>

                <div class="result"></div>

                <form class="moduleFormUp" action="../php/updateModule.php" method="POST">
                    <input type="hidden" name="id" value="<?=$id?>">   

                    <label for="name">Nome:</label>
                    <input type="text" name="name" placeholder="Insira o Nome" id="name">          

                    <input type="submit" value="Atualizar" class="btnSubmit">
                </form>

                <script src="../js/jquery-3.6.0.min.js"></script>
                <script src="../js/principal.js"></script>
            </body>
        </html>
    <?php }