<?php
    include __DIR__ . "/../php/loginVerify.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
</head>
<body>

    <div class="result"></div>

    <form class="clientForm" name="clientForm" action="../php/insertClient.php" method="POST">
        <label for="name">Nome:</label>
        <input type="text" name="name" placeholder="Insira o Nome" id="name" >

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" placeholder="Insira o CPF" id="cpf" >

        <label for="date">Data de Nascimento:</label>
        <input type="date" name="date" id="date" >

        <label>Sexo:</label>
        <input type="radio" name="gender" checked="checked" value="M" >Homem
        <input type="radio" name="gender" value="F" >Mulher
        <input type="radio" name="gender"value="O" >Outro

        <label for="photo">Foto:</label>
        <input type="file" name="photo" id="photo" >

        <label for="state">Estado:</label>
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

        <label for="city">Cidade:</label>
        <input type="text" name="city" placeholder="Insira a Cidade" id="city" >

        <label for="district">Bairro:</label>
        <input type="text" name="district" placeholder="Insira o Bairro" id="district" >             

        <input type="submit" value="Inserir">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/principal.js"></script>
</body>
</html>