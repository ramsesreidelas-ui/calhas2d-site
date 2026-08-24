<?php

require 'config.php';

try {

    /*
    DADOS DO FORMULÁRIO
    */
    $servico = $_POST['servico'];
    $descricao = $_POST['descricao'];

    /*
    DADOS FIXOS
    */
    $cliente_id = 1;
    $valor_total = 0;
    $status = 'Pendente';

    /*
    INSERT
    */
    $sql = "INSERT INTO pedidos 
    (cliente_id, valor_total, status, servico, descricao)
    VALUES
    (:cliente_id, :valor_total, :status, :servico, :descricao)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':cliente_id' => $cliente_id,
        ':valor_total' => $valor_total,
        ':status' => $status,
        ':servico' => $servico,
        ':descricao' => $descricao
    ]);

    echo "Pedido enviado com sucesso!";

} catch (PDOException $e) {

    echo "Erro ao salvar pedido: " . $e->getMessage();

}