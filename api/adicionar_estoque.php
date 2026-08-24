<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");
include_once "db.php";

$dados = json_decode(file_get_contents("php://input"), true);

if (isset($dados['id']) && isset($dados['quantidade'])) {
    $id = intval($dados['id']);
    $qtd = floatval($dados['quantidade']);

    // Aqui usamos o sinal de + para somar ao stock atual
    $sql = "UPDATE estoque SET quantidade_atual = quantidade_atual + $qtd WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["sucesso" => true]);
    } else {
        echo json_encode(["sucesso" => false, "erro" => "Erro ao atualizar banco"]);
    }
}
?>