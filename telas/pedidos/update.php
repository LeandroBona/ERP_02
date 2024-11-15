<?php
require_once '../admin/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pedido_id = $_POST['pedido_id'];
    $novo_status = $_POST['status'];

    try {
        $stmt = $pdo->prepare("UPDATE pedidos SET status = ? WHERE pedido_id = ?");
        $stmt->execute([$novo_status, $pedido_id]);

        header("Location: read.php?success=1");
        exit;
    } catch (Exception $e) {
        echo "Erro ao atualizar status do pedido: " . $e->getMessage();
    }
}
?>
