<?php
require_once '../admin/config.php';


$stmt = $pdo->query("SELECT pedidos.*, 
                            funcionarios.nome AS funcionario_nome, 
                            itens_pedidos.*, 
                            produtos.nome AS produto_nome, 
                            produtos.preco_venda 
                     FROM pedidos 
                     JOIN funcionarios ON pedidos.funcionario_id = funcionarios.funcionario_id
                     LEFT JOIN itens_pedidos ON pedidos.pedido_id = itens_pedidos.pedido_id
                     LEFT JOIN produtos ON itens_pedidos.produto_id = produtos.produto_id");

$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

function calcularValorTotal($pedido_id, $pedidos) {
    $valor_total = 0;
    foreach ($pedidos as $pedido) {
        if ($pedido['pedido_id'] == $pedido_id) {
            $valor_total += $pedido['preco_venda'] * $pedido['quantidade'];
        }
    }
    return $valor_total;
}
?>
<?php include '../componentes/head.php'; ?>
<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container">
        <h2>Lista de Pedidos</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Valor Total</th>
                    <th>Funcionário</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pedidos_grouped = [];
                foreach ($pedidos as $pedido) {
                    $pedidos_grouped[$pedido['pedido_id']][] = $pedido;
                }

                foreach ($pedidos_grouped as $pedido_id => $itens): 
                    $valor_total = calcularValorTotal($pedido_id, $itens);
                ?>
                <tr>
                    <td><?= $pedido_id ?></td>
                    <td><?= $itens[0]['data_pedido'] ?></td>
                    <td><?= $itens[0]['status'] ?></td>
                    <td>R$ <?= number_format($valor_total, 2, ',', '.') ?></td>
                    <td><?= $itens[0]['funcionario_nome'] ?></td>
                    <td>
                        <button class="btn btn-info" data-toggle="modal" data-target="#detalhesModal<?= $pedido_id ?>">
                            Ver Detalhes
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="detalhesModal<?= $pedido_id ?>" tabindex="-1" aria-labelledby="detalhesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detalhesModalLabel">Detalhes do Pedido #<?= $pedido_id ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Data:</strong> <?= $itens[0]['data_pedido'] ?></p>
                                <p><strong>Status:</strong> <?= $itens[0]['status'] ?></p>
                                <p><strong>Valor Total:</strong> R$ <?= number_format($valor_total, 2, ',', '.') ?></p>
                                <p><strong>Funcionário:</strong> <?= $itens[0]['funcionario_nome'] ?></p>

                                <h4>Itens do Pedido</h4>
                                <ul>
                                    <?php foreach ($itens as $item): ?>
                                        <li>
                                            <strong>Produto:</strong> <?= $item['produto_nome'] ?> 
                                            <strong>Preço:</strong> R$ <?= number_format($item['preco_venda'], 2, ',', '.') ?> 
                                            <strong>Quantidade:</strong> <?= $item['quantidade'] ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <form action="update.php" method="post">
                                    <input type="hidden" name="pedido_id" value="<?= $pedido_id ?>">
                                    <div class="form-group">
                                        <label for="status">Atualizar Status:</label>
                                        <select name="status" class="form-control">
                                            <option value="Ativo" <?= $itens[0]['status'] == 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                                            <option value="Inativo" <?= $itens[0]['status'] == 'Inativo' ? 'selected' : '' ?>>Inativo</option>
                                            <option value="Suspenso" <?= $itens[0]['status'] == 'Suspenso' ? 'selected' : '' ?>>Suspenso</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include '../componentes/footer.php'; ?>