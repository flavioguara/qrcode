<?php
include './config.php';
include './conexao.php';
$md5 = $_REQUEST['chave'];
$query_prod = "SELECT * FROM registro where md5= '$md5' ";
$resultado_prod = $conn->prepare($query_prod);
$resultado_prod->execute();
$count = 0;

while ($row_prod = $resultado_prod->fetch(PDO::FETCH_ASSOC)) {
    $count += 1;
    echo "ID: " . $row_prod['id'] . "<br>";
    echo "Nome: " . $row_prod['nome'] . "<br>";
    echo "Chave: " . $row_prod['md5'] . "<br>";
    echo "<img src='" . URL . "imgqrcode/" . $row_prod['qrcode'] . "' width='100'><br><hr>";
}
if ($count > 0) {
    echo 'certificado válido';
} else {
    echo 'Este certificado não valido';
}
