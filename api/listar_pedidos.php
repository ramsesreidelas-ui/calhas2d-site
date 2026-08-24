<?php
include_once "db.php";

// Busca os pedidos junto com o nome do cliente
$sql = "SELECT 
            p.id,
            c.nome as cliente_nome,
            p.valor_total,
            p.data_pedido,
            p.status,
            p.servico,
            p.descricao
        FROM pedidos p
        INNER JOIN clientes c 
        ON p.cliente_id = c.id";

$resultado = $conn->query($sql);

$pedidos = [];

if ($resultado->num_rows > 0) {
    while($linha = $resultado->fetch_assoc()) {
        $pedidos[] = $linha;
    }
}

// Retorna JSON
echo json_encode($pedidos);
?>