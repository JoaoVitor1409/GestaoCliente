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
    <title>Cadastro de Cidades</title>
</head>
<body>
    <form class="cityForm" action="../php/insertCity.php" method="POST">
        <div class="result"></div>
        
        <label for="name"><span>Nome:</span>
            <input type="text" name="name" placeholder="Insira o Nome" id="name" required>
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

        <input type="submit" value="Inserir" class="btnSubmit">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/principal.js"></script>
</body>
</html>