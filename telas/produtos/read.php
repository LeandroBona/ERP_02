<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../admin/config.php';


try {
    
    $sql = "SELECT p.produto_id, p.nome, p.descricao, c.nome AS categoria, f.nome AS fornecedor, 
                   p.preco_venda, p.preco_custo, p.unidade_medida 
            FROM produtos p
            JOIN categorias c ON p.categoria_id = c.categoria_id
            JOIN fornecedores f ON p.fornecedor_id = f.fornecedor_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Erro ao listar produtos: " . $e->getMessage();
    exit;
}
?>

<?php include '../componentes/head.php'; ?>

<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container my-5">
        <h2 class="text-center">Produtos Cadastrados</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Fornecedor</th>
                    <th>Preço de Venda</th>
                    <th>Preço de Custo</th>
                    <th>Unidade de Medida</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['descricao']; ?></td>
                        <td><?php echo $produto['categoria']; ?></td>
                        <td><?php echo $produto['fornecedor']; ?></td>
                        <td>
                            <?php
                            echo "R$ " . number_format($produto['preco_venda'], 2, ',', '.');
                            ?>
                        </td>
                        <td>
                            <?php
                            echo "R$ " . number_format($produto['preco_custo'], 2, ',', '.');
                            ?>
                        </td>
                        <td><?php echo $produto['unidade_medida']; ?></td>
                        <td>
                            <a href="atualizar.php?id=<?php echo $produto['produto_id']; ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete.php?id=<?php echo $produto['produto_id']; ?>" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>

            </tbody>
        </table>
        <div class="text-right">
            <a href="cadastrar.php" class="btn btn-primary mt-3">Cadastrar Novo Fornecedor</a>
        </div>
    </div>

    <?php include '../componentes/footer.php'; ?>