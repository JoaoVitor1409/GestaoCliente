<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <script src="../js/icones.js"></script>
    <title>Login</title>
</head>
<body>    
    <form class="loginForm" name="loginForm" action="../php/control.php" method="POST">
        <div class="result"></div>
        <label for="username"><span class="fas fa-user"></span>
        <input type="text" name="username" placeholder="Insira o Nome do Usuário" id="username" >
        </label>

        <label for="ps"><span class="fas fa-key"></span>
        <input type="password" name="ps" placeholder="Insira a sua Senha" id="ps" >
        </label>

        <input type="submit" value="Acessar" class="btnSubmit">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/principal.js"></script>
</body>
</html>