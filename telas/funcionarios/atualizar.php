<?php
// Conectar ao banco de dados
require_once '../admin/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar os dados do funcionário
    $sql = "SELECT * FROM funcionarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
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
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $funcionario['id'] ?>">

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?= $funcionario['nome'] ?>" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" class="form-control" value="<?= $funcionario['cpf'] ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= $funcionario['email'] ?>" required>
            </div>

            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" id="cargo" name="cargo" class="form-control" value="<?= $funcionario['cargo'] ?>" required>
            </div>

            <div class="form-group">
                <label for="salario">Salário:</label>
                <input type="number" id="salario" name="salario" class="form-control" value="<?= $funcionario['salario'] ?>" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="data_admissao">Data de Admissão:</label>
                <input type="date" id="data_admissao" name="data_admissao" class="form-control" value="<?= $funcionario['data_admissao'] ?>" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control" value="<?= $funcionario['telefone'] ?>" required>
            </div>

            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="read.php" class="btn btn-secondary ml-2">Cancelar</a>
        </form>
    </div>

    <!-- Scripts para o Bootstrap (CDN) -->
    <?php include '../componentes/footer.php'; ?>