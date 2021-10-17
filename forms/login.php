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

    <form class="loginForm" name="loginForm" action="../php/control.php" method="POST">
        <label for="username">Usuário:</label>
        <input type="text" name="username" placeholder="Insira o Nome" id="username" >

        <label for="ps">Senha:</label>
        <input type="password" name="ps" placeholder="Insira o Nome" id="ps" >

        <input type="submit" value="Inserir" class="btnSubmit">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/principal.js"></script>
</body>
</html>