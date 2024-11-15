<?php
require_once '../admin/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Iniciar a transação
        $pdo->beginTransaction();

        // Capturar dados do formulário
        $funcionario_id = $_POST['funcionario_id'];
        $status = $_POST['status'];
        $produto_ids = $_POST['produto_id'];
        $quantidades = $_POST['quantidade'];

        // Calcular valor total do pedido (ajuste para somar os preços dos produtos conforme necessário)
        $valor_total = 0; // Aqui você pode adicionar uma lógica para calcular o valor total com base nos produtos e suas quantidades.

        // Inserir o pedido na tabela `pedidos`
        $sql_pedido = "INSERT INTO pedidos (data_pedido, status, valor_total, funcionario_id) VALUES (NOW(), ?, ?, ?)";
        $stmt_pedido = $pdo->prepare($sql_pedido);
        $stmt_pedido->execute([$status, $valor_total, $funcionario_id]);

        // Pegar o ID do pedido recém-criado
        $pedido_id = $pdo->lastInsertId();

        // Inserir cada item na tabela `itens_pedidos` e atualizar o estoque
        foreach ($produto_ids as $index => $produto_id) {
            $quantidade = $quantidades[$index];

            // Inserir item do pedido
            $sql_item = "INSERT INTO itens_pedidos (pedido_id, produto_id, quantidade) VALUES (?, ?, ?)";
            $stmt_item = $pdo->prepare($sql_item);
            $stmt_item->execute([$pedido_id, $produto_id, $quantidade]);

            // Registrar a movimentação de saída no estoque
            $sql_estoque = "INSERT INTO estoque (produto_id, tipo_movimentacao, quantidade, data_movimentacao) VALUES (?, 'saida', ?, NOW())";
            $stmt_estoque = $pdo->prepare($sql_estoque);
            $stmt_estoque->execute([$produto_id, $quantidade]);
        }

        // Confirmar a transação
        $pdo->commit();

        // Redirecionar após sucesso
        header("Location: read.php?success=1");
        exit;
    } catch (Exception $e) {
        // Reverter a transação em caso de erro
        $pdo->rollBack();
        echo "Erro ao cadastrar pedido: " . $e->getMessage();
    }
}
?>
