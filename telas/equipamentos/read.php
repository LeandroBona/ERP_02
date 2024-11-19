<?php include '../componentes/head.php'; ?>
<body>
    <?php include '../componentes/navbar.php'; ?>

    <div class="container my-5">
        <h2 class="text-center">Manutenções Realizadas</h2>
        <hr>

        <?php
        
        include '../admin/config.php';

        try {
            $sql = "SELECT m.manutencao_id, m.equipamento, m.descricao_problema, m.data_inicio, 
                           m.data_termino, m.status, f.nome AS tecnico_responsavel
                    FROM manutencoes m
                    LEFT JOIN funcionarios f ON m.responsavel_id = f.funcionario_id"; 
            $stmt = $pdo->query($sql);

            $manutencoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($manutencoes) === 0) {
                echo '<div class="alert alert-info">Nenhuma manutenção cadastrada.</div>';
            } else {
                echo '<table class="table table-bordered table-hover mt-4">';
                echo '<thead class="thead-dark">';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Equipamento</th>';
                echo '<th>Descrição</th>';
                echo '<th>Data de Início</th>';
                echo '<th>Data de Término</th>';
                echo '<th>Técnico</th>';
                echo '<th>Status</th>';
                echo '<th>Ações</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($manutencoes as $manutencao) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($manutencao['manutencao_id']) . '</td>'; 
                    echo '<td>' . htmlspecialchars($manutencao['equipamento']) . '</td>';
                    echo '<td>' . htmlspecialchars($manutencao['descricao_problema']) . '</td>';
                    echo '<td>' . htmlspecialchars($manutencao['data_inicio']) . '</td>';
                    echo '<td>' . htmlspecialchars($manutencao['data_termino']) . '</td>';
                    echo '<td>' . htmlspecialchars($manutencao['tecnico_responsavel'] ?? 'Não informado') . '</td>'; 
                    echo '<td>' . htmlspecialchars($manutencao['status']) . '</td>';
                    echo '<td>';
                    echo '<a href="atualizar.php?id=' . $manutencao['manutencao_id'] . '" class="btn btn-warning btn-sm mr-2" title="Editar">
                        <i class="fas fa-edit"></i>
                      </a>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">Erro ao buscar manutenções: ' . $e->getMessage() . '</div>';
        }
        ?>

        <div class="text-right">
            <a href="cadastrar.php" class="btn btn-primary mt-3">Cadastrar Nova Manutenção</a>
        </div>
    </div>

    <?php include '../componentes/footer.php'; ?>

