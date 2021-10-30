<?php
    include __DIR__ . "/../php/loginVerify.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/forms.css">
    <title>Cadastro de Módulos</title>
</head>
<body>
    <form class="moduleForm" action="../php/insertModule.php" method="POST">

        <div class="result"></div>
        
        <label for="name"><span>Nome:</span>
        <input type="text" name="name" placeholder="Insira o Nome do Módulo" id="name" required>
        </label>
        <input type="submit" value="Inserir" class="btnSubmit">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/principal.js"></script>
</body>
</html>