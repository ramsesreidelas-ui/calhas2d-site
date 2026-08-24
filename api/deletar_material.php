<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");
include_once "db.php";

$dados = json_decode(file_get_contents("php://input"), true);

if (isset($dados['id'])) {
    $id = intval($dados['id']);

    $sql = "DELETE FROM estoque WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["sucesso" => true]);
    } else {
        echo json_encode(["sucesso" => false, "erro" => $conn->error]);
    }
}
?>