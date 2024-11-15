<?php
require_once '../admin/config.php';

// Buscar todos os funcionários
$stmt = $pdo->prepare("SELECT funcionario_id, nome FROM funcionarios");
$stmt->execute();
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar todos os produtos
$stmt = $pdo->prepare("SELECT produto_id, nome FROM produtos");
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../componentes/head.php'; ?>
<body>
    <?php include '../componentes/navbar.php'; ?>
<div class="container">
    <h1>Cadastrar Pedido</h1>
    <form action="create.php" method="POST">
        
        <!-- Select para escolher o Funcionário -->
        <div class="form-group">
            <label for="funcionario_id">Funcionário</label>
            <select id="funcionario_id" name="funcionario_id" class="form-control" required>
                <option value="">Selecione um Funcionário</option>
                <?php foreach ($funcionarios as $funcionario): ?>
                    <option value="<?= $funcionario['funcionario_id'] ?>"><?= $funcionario['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Select para escolher o Produto e campo para quantidade -->
        <div class="form-group">
            <label for="produto_id">Produto</label>
            <select id="produto_id" name="produto_id[]" class="form-control" required>
                <option value="">Selecione um Produto</option>
                <?php foreach ($produtos as $produto): ?>
                    <option value="<?= $produto['produto_id'] ?>"><?= $produto['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Campo de Quantidade -->
        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" id="quantidade" name="quantidade[]" class="form-control" min="1" required>
        </div>

        <!-- Campo de Status do Pedido -->
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
                <option value="Suspenso">Suspenso</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Pedido</button>
    </form>
</div>
<?php include '../componentes/footer.php'; ?>
