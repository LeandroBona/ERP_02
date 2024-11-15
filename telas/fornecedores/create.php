<?php

include '../admin/config.php';

// Recebe os dados do formulário de cadastro
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];

try {
    // Prepara a consulta para inserir o fornecedor
    $sql = "INSERT INTO fornecedores (nome, telefone, email, endereco) VALUES (:nome, :telefone, :email, :endereco)";
    $stmt = $pdo->prepare($sql);

    // Atribui os valores aos parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':endereco', $endereco);

    // Executa a consulta
    if ($stmt->execute()) {
        header("Location: read.php");  // Redireciona para a página principal se a exclusão for bem-sucedida
        exit();
    } else {
        echo "Erro ao cadastrar fornecedor.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
