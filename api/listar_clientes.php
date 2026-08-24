<?php
header("Access-Control-Allow-Origin: *"); // ISSO AQUI É OBRIGATÓRIO PARA O CHROME
header("Content-Type: application/json; charset=UTF-8");
include_once "db.php";

$res = $conn->query("SELECT * FROM clientes");
if($res){
    echo json_encode($res->fetch_all(MYSQLI_ASSOC));
} else {
    echo json_encode(["erro" => $conn->error]);
}
?>