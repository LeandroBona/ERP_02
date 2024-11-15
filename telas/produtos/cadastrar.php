<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);  // Exibe erros na tela

include '../admin/config.php';  // Certifique-se de que o caminho do config.php está correto

// Consulta para pegar todas as categorias
$sql_categoria = "SELECT categoria_id, nome FROM categorias";
$stmt_categoria = $pdo->prepare($sql_categoria);
$stmt_categoria->execute();

// Consulta para pegar todos os fornecedores
$sql_fornecedor = "SELECT fornecedor_id, nome FROM fornecedores";
$stmt_fornecedor = $pdo->prepare($sql_fornecedor);
$stmt_fornecedor->execute();
?>

<?php include '../componentes/head.php'; ?>

<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container my-5">
        <h2 class="text-center">Cadastrar Produto</h2>
        <hr>

        <form action="create.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" required><br>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" class="form-control" required></textarea><br>
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoria:</label>
                <select name="categoria_id" id="categoria_id" class="form-control" required>
                    <option value="">Selecione uma categoria</option>
                    <?php while ($categoria = $stmt_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $categoria['categoria_id']; ?>"><?php echo $categoria['nome']; ?></option>
                    <?php } ?>
                </select><br>
            </div>

            <div class="form-group">
                <label for="preco_venda">Preço de Venda:</label>
                <input type="text" name="preco_venda" id="preco_venda" class="form-control"><br>
            </div>

            <div class="form-group">
                <label for="preco_custo">Preço de Custo:</label>
                <input type="text" name="preco_custo" id="preco_custo" class="form-control"><br>
            </div>

            <div class="form-group">
                <label for="unidade_medida">Unidade de Medida:</label>
                <input type="text" name="unidade_medida" id="unidade_medida" class="form-control"><br>
            </div>

            <div class="form-group">
                <label for="fornecedor_id">Fornecedor:</label>
                <select name="fornecedor_id" id="fornecedor_id" class="form-control" required>
                    <option value="">Selecione um fornecedor</option>
                    <?php while ($fornecedor = $stmt_fornecedor->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $fornecedor['fornecedor_id']; ?>"><?php echo $fornecedor['nome']; ?></option>
                    <?php } ?>
                </select><br>
            </div>

            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="read.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <?php include '../componentes/footer.php'; ?>