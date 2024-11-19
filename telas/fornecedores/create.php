<?php

include '../admin/config.php';

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];

try {
    $sql = "INSERT INTO fornecedores (nome, telefone, email, endereco) VALUES (:nome, :telefone, :email, :endereco)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':endereco', $endereco);

    if ($stmt->execute()) {
        header("Location: read.php");  
        exit();
    } else {
        echo "Erro ao cadastrar fornecedor.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
