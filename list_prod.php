<?php
session_start();
include './config.php';
include './conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listar</title>
</head>

<body>
    <a href="index.php">Cadastrar</a><br><br>
    <?php
    echo "<h1>Listar Produtos</h1>";
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    $query_prod = "SELECT * FROM registro";
    $resultado_prod = $conn->prepare($query_prod);
    $resultado_prod->execute();
    while ($row_prod = $resultado_prod->fetch(PDO::FETCH_ASSOC)) {
       // echo "ID: " . $row_prod['id'] . "<br>";
        echo "Nome: " . $row_prod['nome'] . "<br>";
        echo "Chave: " . $row_prod['md5'] . "<br>";
        echo "<img src='" . URL . "imgqrcode/" . $row_prod['qrcode'] . "' width='100'><br><hr>";
    }
    ?>
</body>

</html>