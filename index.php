<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>qrcode</title>
</head>

<body>
    <a href="list_prod.php">Listar</a><br><br>
    <h1>Registro</h1>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form method="POST" action="proc_cad_prod.php">
        <label>Nome:</label>
        <input type="text" name="nome" placeholder="Nome"><br><br>

        <input type="submit" value="Gerar carta patente">
    </form>
</body>

</html>