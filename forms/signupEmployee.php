<?php
    include __DIR__ . "/../php/loginVerify.php";
    include __DIR__ . "/../admin/crud.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/icones.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/forms.css">
    <title>Cadastro de Funcionarios</title>
</head>
<body>

    

    <form class="employeeForm" name="employeeForm" action="../php/insertEmployee.php" method="POST">
        <div class="result"></div>
        
        <div class="loading">
            <div class="progress"></div>
        </div>

        <label for="name"><span>Nome:</span>
        <input type="text" name="name" placeholder="Insira o Nome" id="name">
        </label>

        <label for="username"><span>Usuário:</span>
        <input type="text" name="username" placeholder="Insira o nome de usuário" id="username">
        </label>

        <label for="ps"><span>Senha:</span>
        <input type="password" name="ps" placeholder="Insira a sua senha" id="ps">
        </label>

        <label for="cpf"><span>CPF:</span>
        <input type="text" name="cpf" placeholder="Insira o CPF" id="cpf">
        </label>

        <label for="date"><span>Nascimento:</span>
        <input type="date" name="date" id="date">
        </label>
        
        <div id='gender'>
            <label class="label"><span>Sexo:</span></label>
            <label class='radios'>
            <label for='m' id='male'>Homem</label><input  id="m" type="radio" name="gender" checked="checked" value="M" >
            <label for='f' id='female'>Mulher</label><input id="f"  type="radio" name="gender" value="F" >
            <label for='o' id='other'>Outro</label><input id="o"  type="radio" name="gender"value="O" >
            </label>
        </div>

        <label for="photo"><span class="fas fa-upload"></span><span>Inserir Foto</span>
        <input type="file" name="photo" id="photo" >
        </label>

        <label for="state"><span>Estado:</span>
        <select name="state">
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

        <div class="btns">
        <span class="fas fa-plus addModule"></span><span>Adicionar Módulo</span><br>
        <span class="fas fa-minus remModule"></span><span>Remover Módulo</span>
        </div>      

        <div id="modules">
            <label><span>Módulo:</span>
                <select name="module">
                    <option value="NA">Nenhum Módulo</option>
                    <?php 
                        $result = Read("Modulo", "*");
                        foreach($result as $module){?>
                            <option value="<?=$module['ModuloID']?>"><?=$module['ModuloNome']?></option>                
                    <?php }?>                
            </select>   
            </label>     
        </div>
        

        <input class="submit" type="submit" value="Inserir">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/scrollToMin.js"></script>
    <script src="../js/jqueryMask.js"></script>
    <script src="../js/principal.js"></script>
</body>
</html>