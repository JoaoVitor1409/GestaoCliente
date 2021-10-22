<?php
    include __DIR__ . "/../php/loginVerify.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Módulos</title>
</head>
<body>

    <div class="result"></div>

    <form class="moduleForm" action="../php/insertModule.php" method="POST">
        <label for="name">Nome:</label>
        <input type="text" name="name" placeholder="Insira o Nome do Módulo" id="name" required>

        <input type="submit" value="Inserir" class="btnSubmit">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/principal.js"></script>
</body>
</html>