<?php
// Conectar ao banco de dados
include '../admin/config.php';

// Verificar se o ID do produto foi passado pela URL
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];

    // Buscar os dados do produto
    $sql = "SELECT * FROM produtos WHERE produto_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$produto_id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        die("Produto não encontrado.");
    }
} else {
    die("ID do produto não fornecido.");
}

$categorias_sql = "SELECT * FROM categorias";
$categorias_stmt = $pdo->prepare($categorias_sql);
$categorias_stmt->execute();
$categorias = $categorias_stmt->fetchAll(PDO::FETCH_ASSOC);

$fornecedores_sql = "SELECT * FROM fornecedores";
$fornecedores_stmt = $pdo->prepare($fornecedores_sql);
$fornecedores_stmt->execute();
$fornecedores = $fornecedores_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../componentes/head.php'; ?>

<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container">
        <h2 class="mt-5">Atualizar Produto</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="produto_id" value="<?php echo $produto['produto_id']; ?>">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $produto['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" class="form-control" required><?php echo $produto['descricao']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria" class="form-control" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['categoria_id']; ?>" <?php echo $categoria['categoria_id'] == $produto['categoria_id'] ? 'selected' : ''; ?>>
                            <?php echo $categoria['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fornecedor">Fornecedor</label>
                <select name="fornecedor" id="fornecedor" class="form-control" required>
                    <?php foreach ($fornecedores as $fornecedor): ?>
                        <option value="<?php echo $fornecedor['fornecedor_id']; ?>" <?php echo $fornecedor['fornecedor_id'] == $produto['fornecedor_id'] ? 'selected' : ''; ?>>
                            <?php echo $fornecedor['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="preco_venda">Preço de Venda</label>
                    <input type="number" name="preco_venda" id="preco_venda" class="form-control" value="<?php echo $produto['preco_venda']; ?>" step="0.01" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="preco_custo">Preço de Custo</label>
                    <input type="number" name="preco_custo" id="preco_custo" class="form-control" value="<?php echo $produto['preco_custo']; ?>" step="0.01" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="unidade_medida">Unidade de Medida</label>
                    <input type="text" name="unidade_medida" id="unidade_medida" class="form-control" value="<?php echo $produto['unidade_medida']; ?>" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>

    <?php include '../componentes/footer.php'; ?>