<?php
// Conectar ao banco de dados
require_once '../admin/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir o funcionário
    $sql = "DELETE FROM funcionarios WHERE funcionario_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header('Location: read.php');
    exit;
} else {
    header('Location: read.php');
    exit;
}
?>
