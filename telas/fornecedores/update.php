<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../admin/config.php';

// Verifica se o 'id' foi passado via GET
if (isset($_GET['id'])) {
    $fornecedor_id = $_GET['id'];  // Pega o ID do fornecedor da URL
} else {
    echo "Erro: ID do fornecedor não encontrado!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    try {
        // Prepara a consulta para atualizar o fornecedor
        $sql = "UPDATE fornecedores SET nome = :nome, telefone = :telefone, email = :email, endereco = :endereco WHERE fornecedor_id = :fornecedor_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':fornecedor_id', $fornecedor_id, PDO::PARAM_INT);

        // Executa a consulta para atualizar
        if ($stmt->execute()) {
            // Redireciona para a página de listagem após o sucesso
            header("Location: read.php");
            exit;
        } else {
            echo "<script>alert('Erro ao atualizar fornecedor!');</script>";
        }
    } catch (PDOException $e) {
        echo "Erro ao atualizar: " . $e->getMessage();
    }
}
?>
