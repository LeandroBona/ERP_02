<?php
require_once '../admin/config.php';

$sql = "SELECT p.produto_id, p.nome, SUM(e.quantidade) as quantidade
        FROM produtos p
        LEFT JOIN estoque e ON p.produto_id = e.produto_id
        GROUP BY p.produto_id, p.nome";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../componentes/head.php'; ?>

<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container">
        <h2 class="mt-5">Estoque de Produtos</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome do Produto</th>
                    <th>Quantidade em Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['quantidade']; ?></td>
                        <td>
                            <a href="adicionar_estoque.php?id=<?php echo $produto['produto_id']; ?>&quantidade=1" class="btn btn-success btn-sm">
                                <i class="bi bi-plus-circle"></i> 
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include '../componentes/footer.php'; ?>
</body>