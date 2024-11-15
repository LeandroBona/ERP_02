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

try {
    // Prepara a consulta para buscar o fornecedor usando o 'fornecedor_id'
    $sql = "SELECT * FROM fornecedores WHERE fornecedor_id = :fornecedor_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':fornecedor_id', $fornecedor_id, PDO::PARAM_INT);
    $stmt->execute();
    $fornecedor = $stmt->fetch(PDO::FETCH_ASSOC);  // Armazena o resultado na variável $fornecedor

    // Se o fornecedor não for encontrado, exibe uma mensagem de erro
    if (!$fornecedor) {
        echo "Fornecedor não encontrado!";
        exit;
    }
} catch (PDOException $e) {
    echo "Erro ao buscar fornecedor: " . $e->getMessage();
    exit;
}
?>

<?php include '../componentes/head.php'; ?>
<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container my-5">
        <h2 class="text-center">Editar Fornecedor</h2>
        <hr>

        <form action="update.php?id=<?php echo $fornecedor_id; ?>" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($fornecedor['nome']); ?>" class="form-control" required><br>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($fornecedor['telefone']); ?>" class="form-control" required><br>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($fornecedor['email']); ?>" class="form-control" required><br>
            </div>

            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" id="endereco" value="<?php echo htmlspecialchars($fornecedor['endereco']); ?>" class="form-control" required><br>
            </div>

            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="read.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <?php include '../componentes/footer.php'; ?>