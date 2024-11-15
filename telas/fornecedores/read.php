<?php include '../componentes/head.php'; ?>
<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container my-5">
        <h2 class="text-center">Lista de Fornecedores</h2>
        <hr>

        <?php
        // Incluir o arquivo de configuração para conectar ao banco
        include '../admin/config.php';

        try {
            // Consulta para buscar todos os fornecedores
            $sql = "SELECT * FROM fornecedores";
            $stmt = $pdo->query($sql);

            // Verifica se existem fornecedores cadastrados
            $fornecedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($fornecedores) === 0) {
                echo '<div class="alert alert-info">Nenhum fornecedor cadastrado.</div>';
            } else {
                // Exibe os fornecedores em uma tabela
                echo '<table class="table table-bordered table-hover mt-4">';
                echo '<thead class="thead-dark">';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Nome</th>';
                echo '<th>Telefone</th>';
                echo '<th>Email</th>';
                echo '<th>Endereço</th>';
                echo '<th>Ações</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($fornecedores as $fornecedor) {
                    echo '<tr>';
                    // Verifica se o índice 'id' existe no array do fornecedor
                    if (isset($fornecedor['fornecedor_id'])) {
                        echo '<td>' . htmlspecialchars($fornecedor['fornecedor_id']) . '</td>';
                        echo '<td>' . htmlspecialchars($fornecedor['nome']) . '</td>';
                        echo '<td>' . htmlspecialchars($fornecedor['telefone']) . '</td>';
                        echo '<td>' . htmlspecialchars($fornecedor['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($fornecedor['endereco']) . '</td>';
                        echo '<td>';
                        echo '<a href="atualizar.php?id=' . $fornecedor['fornecedor_id'] . '" class="btn btn-warning btn-sm mr-2">Editar</a>';
                        echo '<a href="delete.php?fornecedor_id=' . $fornecedor['fornecedor_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza que deseja excluir este fornecedor?\');">Excluir</a>';


                        echo '</td>';
                    } else {
                        // Caso o 'id' não exista, exibe uma mensagem de erro
                        echo '<td colspan="6" class="text-danger">Erro: ID do fornecedor não encontrado.</td>';
                    }
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">Erro ao buscar fornecedores: ' . $e->getMessage() . '</div>';
        }
        ?>

        <!-- Botão para adicionar um novo fornecedor -->
        <div class="text-right">
            <a href="cadastrar.php" class="btn btn-primary mt-3">Cadastrar Novo Fornecedor</a>
        </div>
    </div>

    <?php include '../componentes/footer.php'; ?>