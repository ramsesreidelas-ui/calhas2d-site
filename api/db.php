<?php
// Configurações de acesso
$host = "localhost";
$user = "root";
$pass = ""; // No XAMPP a senha é vazia
$db   = "calhas2d";

// Conecta ao MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Ajusta para aceitar acentos (UTF-8)
mysqli_set_charset($conn, "utf8");

// Permite que o App acesse a API (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
?>