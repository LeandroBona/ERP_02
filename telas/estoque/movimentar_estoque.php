<?php
// Conectar ao banco de dados
require_once '../admin/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $produto_id = $_POST['produto_id'];
    $tipo_movimentacao = $_POST['tipo_movimentacao'];
    $quantidade = $_POST['quantidade'];
    $data_movimentacao = date('Y-m-d H:i:s'); // Data e hora atual

    // Depuração: verificar os valores recebidos do formulário
    var_dump($_POST); // Verifique o conteúdo de $_POST
    var_dump($quantidade); // Verifique o valor da quantidade

    // Verificar se a quantidade é válida
    if (empty($quantidade) || !is_numeric($quantidade)) {
        die("Erro: A quantidade deve ser um número válido.");
    }

    // Inserir a movimentação no banco de dados (tabela estoque)
    $sql = "INSERT INTO estoque (produto_id, tipo_movimentacao, quantidade, data_movimentacao) 
            VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$produto_id, $tipo_movimentacao, $quantidade, $data_movimentacao]);

    // Atualizar a quantidade de estoque com base na movimentação
    if ($tipo_movimentacao == 'entrada') {
        // Se for entrada, somar a quantidade
        $sql_update = "UPDATE produtos 
                       SET quantidade = quantidade + ? 
                       WHERE produto_id = ?";
    } elseif ($tipo_movimentacao == 'saida') {
        // Se for saída, subtrair a quantidade
        $sql_update = "UPDATE produtos 
                       SET quantidade = quantidade - ? 
                       WHERE produto_id = ?";
    } elseif ($tipo_movimentacao == 'devolucao') {
        // Se for devolução, somar a quantidade
        $sql_update = "UPDATE produtos 
                       SET quantidade = quantidade + ? 
                       WHERE produto_id = ?";
    } else {
        die("Erro: Tipo de movimentação inválido.");
    }

    // Executar a atualização na tabela de produtos
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([$quantidade, $produto_id]);

    // Verificar se a atualização foi realizada corretamente
    if ($stmt_update->rowCount() > 0) {
        // Redirecionar para a página de estoque
        header('Location: estoque.php');
        exit;
    } else {
        die("Erro: Não foi possível atualizar o estoque.");
    }

} else {
    // Se não for uma requisição POST, redirecionar para a página de estoque
    header('Location: estoque.php');
    exit;
}
?>
