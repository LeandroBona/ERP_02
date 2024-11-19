<?php
require_once '../admin/config.php';

$sql = "SELECT * FROM setores";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$setores = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $setor_id = $_POST['setor_id'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data_admissao = $_POST['data_admissao'];
    $salario = $_POST['salario'];
    $metodo_pagamento = $_POST['metodo_pagamento'];

    $sql = "INSERT INTO funcionarios (nome, cargo, setor_id, telefone, email, data_admissao, salario, metodo_pagamento) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $cargo, $setor_id, $telefone, $email, $data_admissao, $salario, $metodo_pagamento]);

    header('Location: read.php');
    exit;
}
