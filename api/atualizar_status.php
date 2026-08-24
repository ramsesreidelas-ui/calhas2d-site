<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// 1. Conexão (Verifique se os dados estão certos)
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "calhas2d"; // COLOQUE O NOME DO SEU BANCO AQUI

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// 2. Receber os dados do Flutter
$id = $_POST['id'] ?? null;
$status = $_POST['status'] ?? null;

if ($id && $status) {
    // 3. O SQL (Verifique se o nome da tabela é 'pedidos')
    $sql = "UPDATE pedidos SET status = '$status' WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["res" => "Sucesso"]);
    } else {
        echo json_encode(["res" => "Erro no SQL: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["res" => "Dados não recebidos pelo PHP"]);
}

mysqli_close($conn);
?>