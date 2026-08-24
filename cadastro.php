<?php

require_once "config.php";

// Pegando dados do formulário
$nome      = $_POST['nome'] ?? '';
$telefone  = $_POST['telefone'] ?? '';
$email     = $_POST['email'] ?? '';
$endereco  = $_POST['endereco'] ?? '';
$cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');

$senha = $_POST['senha'] ?? '';
$confirmar_senha = $_POST['confirmar_senha'] ?? '';


// Validação básica
if (!$nome ||
 !$telefone ||
  !$email ||
   !$endereco ||
    !$cpf ||
    !$senha ||
    !$confirmar_senha
     ) {
    echo "Preencha todos os campos.";
    exit;
}

if ($senha !== $confirmar_senha) {

    echo "
    
    <style>
    
    body{
        margin:0;
        height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background: radial-gradient(circle at top, #eef5ff, #dbeafe);
        font-family:Poppins,sans-serif;
    }

    .error-box{
        background:white;
        padding:40px;
        border-radius:20px;
        box-shadow:0 20px 40px rgba(0,0,0,.12);
        text-align:center;
        width:400px;
    }

    .error-icon{
        width:80px;
        height:80px;
        background:#ffe5e5;
        color:#ff3b3b;

        display:flex;
        align-items:center;
        justify-content:center;

        border-radius:50%;

        font-size:40px;

        margin:auto;
        margin-bottom:20px;
    }

    h2{
        color:#0b2545;
        margin-bottom:10px;
    }

    p{
        color:#64748b;
        margin-bottom:25px;
    }

    .btn-back{
        display:inline-block;

        padding:12px 20px;

        border-radius:12px;

        background:#0d6efd;

        color:white;
        text-decoration:none;

        transition:.3s;
    }

    .btn-back:hover{
        transform:translateY(-2px);
    }

    </style>

    <div class='error-box'>

        <div class='error-icon'>
            ✕
        </div>

        <h2>Senhas Diferentes</h2>

        <p>
            As senhas digitadas não coincidem.
        </p>

        <a href='javascript:history.back()' class='btn-back'>
            Voltar
        </a>

    </div>

    ";

    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {

    // Inserção no banco
    $sql = "INSERT INTO clientes (nome, telefone, email, endereco, cpf, senha)
            VALUES (:nome, :telefone, :email, :endereco, :cpf, :senha)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nome' => $nome,
        ':telefone' => $telefone,
        ':email' => $email,
        ':endereco' => $endereco,
        ':cpf' => $cpf,
        ':senha' => $senhaHash
        
    ]);

    header("Location: sucesso.php");
exit;

} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
}