<?php

namespace chillerlan\QRCodeExamples;

use chillerlan\QRCode\{QRCode, QROptions};

include './vendor/autoload.php';
include './config.php';
include './conexao.php';
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$date_create = date_create();
$timestamp = date_timestamp_get($date_create);
$crc64 = ('cdsx' . hash('crc32', $nome) . hash('crc32b', $timestamp));
$url = URL . "validar.php?chave=" . $crc64;
echo $url;
$options = new QROptions([
	'version'    => 5,
	'outputType' => QRCode::OUTPUT_MARKUP_SVG,
	'eccLevel'   => QRCode::ECC_L,
]);
$qrcode = new QRCode($options);
$nome_qrcode =  $crc64 . '.svg';
$qrcode->render($url, 'imgqrcode/' . $nome_qrcode);
$query_prod = "insert into registro (nome, md5, timestamp, qrcode) value (:nome, :crc64, :timestamp, :nome_qrcode)";
$cadastrar = $conn->prepare($query_prod);
$cadastrar->bindParam(':nome', $nome);
$cadastrar->bindParam(':crc64', $crc64);
$cadastrar->bindParam(':timestamp', $timestamp);
$cadastrar->bindParam(':nome_qrcode', $nome_qrcode);

if ($cadastrar->execute()) {
	echo "<br>cadastrado<br>";
	echo "<a href='index.php'> voltar</a>";
} else {
	echo "Erro ao cadastar";
}
