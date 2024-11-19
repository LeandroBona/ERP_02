<?php
require_once '../admin/config.php';

if (isset($_GET['id']) && isset($_GET['quantidade'])) {
    $produto_id = $_GET['id'];
    $quantidade = $_GET['quantidade'];

    if (!is_numeric($quantidade) || $quantidade <= 0) {
        die("Erro: A quantidade deve ser um número válido e maior que zero.");
    }

    $sql_check = "SELECT quantidade FROM produtos WHERE produto_id = ?";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([$produto_id]);
    $produto = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($produto && $produto['quantidade'] < $quantidade) {
        die("Erro: Quantidade insuficiente no estoque.");
    }

    $data_movimentacao = date('Y-m-d H:i:s'); 
    $sql = "INSERT INTO estoque (produto_id, tipo_movimentacao, quantidade, data_movimentacao) 
            VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    $tipo_movimentacao = 'saida';
    $stmt->execute([$produto_id, $tipo_movimentacao, $quantidade, $data_movimentacao]);

    $sql_update = "UPDATE produtos 
                   SET quantidade = quantidade - ? 
                   WHERE produto_id = ?";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([$quantidade, $produto_id]);

 
    header('Location: estoque.php');
    exit;
} else {
    die("Erro: ID de produto ou quantidade não fornecidos.");
}
?>
