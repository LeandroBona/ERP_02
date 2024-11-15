<?php
// Conectar ao banco de dados
require_once '../admin/config.php';

try {
    // Consulta para recuperar todos os setores
    $sql = "SELECT setor_id, nome FROM setores";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $setores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$setores) {
        echo "<script>alert('Nenhum setor encontrado!');</script>";
    }
} catch (PDOException $e) {
    echo "Erro ao buscar setores: " . $e->getMessage();
}
?>

<?php include '../componentes/head.php'; ?>
<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastrar Novo Funcionário</h1>
        
        <form action="create.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" id="cargo" name="cargo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="setor_id">Setor:</label>
                <select name="setor_id" id="setor_id" class="form-control" required>
                    <?php foreach ($setores as $setor): ?>
                        <option value="<?= $setor['setor_id'] ?>"><?= $setor['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="data_admissao">Data de Admissão:</label>
                <input type="date" id="data_admissao" name="data_admissao" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="salario">Salário:</label>
                <input type="number" id="salario" name="salario" class="form-control" step="0.01">
            </div>

            <div class="form-group">
                <label for="metodo_pagamento">Método de Pagamento:</label>
                <input type="text" id="metodo_pagamento" name="metodo_pagamento" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <?php include '../componentes/footer.php'; ?>