<?php
include '../admin/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipamento = $_POST['equipamento'];
    $descricao_problema = $_POST['descricao_problema'];
    $data_inicio = $_POST['data_inicio'];
    $data_termino = $_POST['data_termino'] ?? null;
    $status = $_POST['status'];
    $responsavel_id = $_POST['responsavel_id']; 

    $sql = "INSERT INTO manutencoes (equipamento, descricao_problema, data_inicio, data_termino, status, responsavel_id)
            VALUES (:equipamento, :descricao_problema, :data_inicio, :data_termino, :status, :responsavel_id)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':equipamento' => $equipamento,
        ':descricao_problema' => $descricao_problema,
        ':data_inicio' => $data_inicio,
        ':data_termino' => $data_termino,
        ':status' => $status,
        ':responsavel_id' => $responsavel_id,
    ]);

    header('Location: read.php');
    exit;
}
?>
