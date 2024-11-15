<?php
// Conectar ao banco de dados
require_once '../admin/config.php';

// Verificar se o ID do produto foi passado pela URL
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];

    // Buscar os dados do produto
    $sql = "SELECT nome FROM produtos WHERE produto_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$produto_id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        die("Produto não encontrado.");
    }
} else {
    die("ID do produto não fornecido.");
}
?>

<?php include '../componentes/head.php'; ?>
<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container">
        <h2 class="mt-5">Editar Estoque - <?php echo $produto['nome']; ?></h2>
        <form action="movimentar_estoque.php" method="POST">
            <input type="hidden" name="produto_id" value="<?php echo $produto_id; ?>">
            <div class="form-group">
                <label for="tipo_movimentacao">Tipo de Movimentação</label>
                <select name="tipo_movimentacao" id="tipo_movimentacao" class="form-control" required>
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                    <option value="devolucao">Devolução</option>
                </select>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Estoque</button>
        </form>
    </div>
    <?php include '../componentes/footer.php'; ?>
