<?php
include '../admin/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto_id = $_POST['produto_id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $fornecedor = $_POST['fornecedor'];
    $preco_venda = $_POST['preco_venda'];
    $preco_custo = $_POST['preco_custo'];
    $unidade_medida = $_POST['unidade_medida'];

    $sql = "UPDATE produtos SET nome = ?, descricao = ?, categoria_id = ?, fornecedor_id = ?, preco_venda = ?, preco_custo = ?, unidade_medida = ? WHERE produto_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $categoria, $fornecedor, $preco_venda, $preco_custo, $unidade_medida, $produto_id]);

    header('Location: read.php');
    exit;
} else {
    header('Location: read.php');
    exit;
}
?>
