<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once "db.php";

// Buscando os nomes REAIS da sua tabela estoque
$sql = "SELECT id, item_nome, quantidade_atual, quantidade_minima, unidade_medida FROM estoque";
$result = $conn->query($sql);

$estoque = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $estoque[] = $row;
    }
}

// Isso vai imprimir exatamente o que o Flutter precisa ler
echo json_encode($estoque);
?>