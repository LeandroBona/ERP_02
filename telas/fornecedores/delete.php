<?php
include '../admin/config.php';

if (isset($_GET['fornecedor_id'])) {  // Verifique o parâmetro 'fornecedor_id' na URL
    $id = $_GET['fornecedor_id'];
    try {
        // SQL para excluir fornecedor, usando o nome correto da coluna 'fornecedor_id'
        $sql = "DELETE FROM fornecedores WHERE fornecedor_id = :fornecedor_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fornecedor_id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: read.php");  // Redireciona para a página principal se a exclusão for bem-sucedida
            exit();
        } else {
            echo '<div class="alert alert-danger">Erro ao excluir fornecedor.</div>';
        }
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Erro na conexão: ' . $e->getMessage() . '</div>';
    }
} else {
    echo '<div class="alert alert-danger">Erro: ID do fornecedor não encontrado.</div>';
}
?>
