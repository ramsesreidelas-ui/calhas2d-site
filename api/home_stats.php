<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once "db.php";

// Contagem de Clientes
$resClientes = $conn->query("SELECT COUNT(*) as total FROM clientes");
$totalClientes = $resClientes->fetch_assoc()['total'];

// Conta apenas itens onde a quantidade atual é menor que a mínima configurada
$resEstoque = $conn->query("SELECT COUNT(*) as total FROM estoque WHERE quantidade_atual < quantidade_minima");
$totalEstoque = $resEstoque->fetch_assoc()['total'];

// Faturamento Total (Exemplo: soma de pedidos finalizados)
$resFaturamento = $conn->query("SELECT SUM(valor_total) as total FROM pedidos WHERE status = 'finalizado'");
$faturamento = $resFaturamento->fetch_assoc()['total'] ?? 0;

// Pedidos Pendentes
$resPedidos = $conn->query("SELECT COUNT(*) as total FROM pedidos WHERE status = 'pendente'");
$totalPedidos = $resPedidos->fetch_assoc()['total'];

echo json_encode([
    "clientes" => $totalClientes,
    "estoque" => $totalEstoque,
    "faturamento" => number_format($faturamento, 2, ',', '.'),
    "pedidos" => $totalPedidos
]);
?>