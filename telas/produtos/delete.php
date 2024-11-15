<?php
// Conectar ao banco de dados
include '../admin/config.php';


// Verificar se o ID do produto foi passado pela URL
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];

    // Excluir o produto
    $sql = "DELETE FROM produtos WHERE produto_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$produto_id]);

    // Redirecionar de volta para a página de listagem
    header('Location: read.php');
    exit;
} else {
    die("ID do produto não fornecido.");
}
?>
