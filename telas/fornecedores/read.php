<?php include '../componentes/head.php'; ?>

<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container my-5">
        <h2 class="text-center">Lista de Fornecedores</h2>
        <hr>

        <?php
        include '../admin/config.php';

        try {
            $sql = "SELECT * FROM fornecedores";
            $stmt = $pdo->query($sql);

            $fornecedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($fornecedores) === 0) {
                echo '<div class="alert alert-info">Nenhum fornecedor cadastrado.</div>';
            } else {
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
                    if (isset($fornecedor['fornecedor_id'])) {
                        echo '<td>' . htmlspecialchars($fornecedor['fornecedor_id']) . '</td>';
                        echo '<td>' . htmlspecialchars($fornecedor['nome']) . '</td>';
                        echo '<td>' . htmlspecialchars($fornecedor['telefone']) . '</td>';
                        echo '<td>' . htmlspecialchars($fornecedor['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($fornecedor['endereco']) . '</td>';
                        echo '<td>';
                        echo '<a href="atualizar.php?id=' . $fornecedor['fornecedor_id'] . '" class="btn btn-warning btn-sm mr-2" title="Editar">
        <i class="fas fa-edit"></i>
      </a>';
                        echo '<a href="delete.php?fornecedor_id=' . $fornecedor['fornecedor_id'] . '" class="btn btn-danger btn-sm" title="Excluir" onclick="return confirm(\'Tem certeza que deseja excluir este fornecedor?\');">
        <i class="fas fa-trash-alt"></i>
      </a>';



                        echo '</td>';
                    } else {
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

        <div class="text-right">
            <a href="cadastrar.php" class="btn btn-primary mt-3">Cadastrar Novo Fornecedor</a>
        </div>
    </div>

    <?php include '../componentes/footer.php'; ?>