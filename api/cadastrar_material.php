<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");
include_once "db.php";

$dados = json_decode(file_get_contents("php://input"), true);

if (isset($dados['nome']) && isset($dados['quantidade'])) {
    $nome = $conn->real_escape_string($dados['nome']);
    $qtd = floatval($dados['quantidade']);
    $unidade = $conn->real_escape_string($dados['unidade']);
    $min = floatval($dados['minimo']);

    $sql = "INSERT INTO estoque (item_nome, quantidade_atual, quantidade_minima, unidade_medida) 
            VALUES ('$nome', $qtd, $min, '$unidade')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["sucesso" => true]);
    } else {
        echo json_encode(["sucesso" => false, "erro" => $conn->error]);
    }
}
?>