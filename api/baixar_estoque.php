<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

include_once "db.php";

// Recebe os dados do Flutter
$dados = json_decode(file_get_contents("php://input"), true);

if (isset($dados['id']) && isset($dados['quantidade'])) {
    $id = intval($dados['id']);
    $qtd = floatval($dados['quantidade']);

    // O comando SQL usa 'quantidade_atual' para bater com seu banco
    // A condição 'AND quantidade_atual >= $qtd' impede estoque negativo
    $sql = "UPDATE estoque 
            SET quantidade_atual = quantidade_atual - $qtd 
            WHERE id = $id AND quantidade_atual >= $qtd";
    
    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo json_encode(["sucesso" => true]);
        } else {
            // Se chegou aqui, o ID não existe ou a quantidade em estoque é menor que a baixa
            echo json_encode(["sucesso" => false, "erro" => "Estoque insuficiente ou item nao encontrado"]);
        }
    } else {
        echo json_encode(["sucesso" => false, "erro" => "Erro no banco: " . $conn->error]);
    }
} else {
    echo json_encode(["sucesso" => false, "erro" => "Dados invalidos"]);
}
?>
