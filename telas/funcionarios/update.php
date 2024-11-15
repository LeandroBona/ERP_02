<?php
// Conectar ao banco de dados
require_once '../admin/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar o funcionário para edição
    $sql = "SELECT * FROM funcionarios WHERE funcionario_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$funcionario) {
        die("Funcionário não encontrado.");
    }

    // Buscar todos os setores
    $sql = "SELECT * FROM setores";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $setores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $cargo = $_POST['cargo'];
        $setor_id = $_POST['setor_id'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $data_admissao = $_POST['data_admissao'];
        $salario = $_POST['salario'];
        $metodo_pagamento = $_POST['metodo_pagamento'];

        // Atualizar o funcionário no banco de dados
        $sql = "UPDATE funcionarios SET nome = ?, cargo = ?, setor_id = ?, telefone = ?, email = ?, data_admissao = ?, salario = ?, metodo_pagamento = ? WHERE funcionario_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $cargo, $setor_id, $telefone, $email, $data_admissao, $salario, $metodo_pagamento, $id]);

        header('Location: read.php');
        exit;
    }
} else {
    header('Location: read.php');
    exit;
}
?>

<?php include '../componentes/head.php'; ?>
<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="mb-4">Atualizar Funcionário</h1>
        
        <!-- Formulário de Atualização -->
        <form action="update.php?id=<?= $funcionario['funcionario_id'] ?>" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?= $funcionario['nome'] ?>" required>
            </div>

            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" id="cargo" name="cargo" class="form-control" value="<?= $funcionario['cargo'] ?>" required>
            </div>

            <div class="form-group">
                <label for="setor_id">Setor:</label>
                <select name="setor_id" id="setor_id" class="form-control" required>
                    <?php foreach ($setores as $setor): ?>
                        <option value="<?= $setor['setor_id'] ?>" <?= $setor['setor_id'] == $funcionario['setor_id'] ? 'selected' : '' ?>>
                            <?= $setor['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control" value="<?= $funcionario['telefone'] ?>">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= $funcionario['email'] ?>" required>
            </div>

            <div class="form-group">
                <label for="data_admissao">Data de Admissão:</label>
                <input type="date" id="data_admissao" name="data_admissao" class="form-control" value="<?= $funcionario['data_admissao'] ?>" required>
            </div>

            <div class="form-group">
                <label for="salario">Salário:</label>
                <input type="number" id="salario" name="salario" class="form-control" value="<?= $funcionario['salario'] ?>" step="0.01">
            </div>

            <div class="form-group">
                <label for="metodo_pagamento">Método de Pagamento:</label>
                <input type="text" id="metodo_pagamento" name="metodo_pagamento" class="form-control" value="<?= $funcionario['metodo_pagamento'] ?>">
            </div>

            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="read.php" class="btn btn-secondary ml-2">Cancelar</a>
        </form>
    </div>

    <?php include '../componentes/footer.php'; ?>