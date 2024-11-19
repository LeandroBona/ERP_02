<?php
require_once '../admin/config.php';

$sql = "SELECT f.funcionario_id, f.nome, f.cargo, f.telefone, f.email, f.data_admissao, f.salario, f.metodo_pagamento, s.nome AS setor
        FROM funcionarios f
        INNER JOIN setores s ON f.setor_id = s.setor_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../componentes/head.php'; ?>

<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="mb-4">Funcionários Cadastrados</h1>
        <a href="cadastrar.php" class="btn btn-success mb-4">Cadastrar Novo Funcionário</a>

        <div class="row">
            <?php foreach ($funcionarios as $funcionario): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $funcionario['nome'] ?></h5>
                            <p class="card-text"><strong>Cargo:</strong> <?= $funcionario['cargo'] ?></p>
                            <p class="card-text"><strong>Setor:</strong> <?= $funcionario['setor'] ?></p>
                            <p class="card-text"><strong>Salário:</strong> R$ <?= number_format($funcionario['salario'], 2, ',', '.') ?></p>
                            <p class="card-text"><strong>Email:</strong> <?= $funcionario['email'] ?></p>
                            <p class="card-text"><strong>Data de Admissão:</strong> <?= date('d/m/Y', strtotime($funcionario['data_admissao'])) ?></p>
                            <p class="card-text"><strong>Telefone:</strong> <?= $funcionario['telefone'] ?></p>
                            <a href="update.php?id=<?= $funcionario['funcionario_id'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Atualizar
                            </a>
                            <a href="delete.php?id=<?= $funcionario['funcionario_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">
                                <i class="fas fa-trash-alt"></i> Excluir
                            </a>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include '../componentes/footer.php'; ?>