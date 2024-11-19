<?php
include '../admin/config.php';

$id = $_GET['id']; 

try {
    $stmt = $pdo->prepare("SELECT * FROM manutencoes WHERE manutencao_id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        echo '<div class="alert alert-danger">Manutenção não encontrada.</div>';
        exit;
    }
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Erro ao buscar manutenção: ' . $e->getMessage() . '</div>';
    exit;
}
?>

<?php include '../componentes/head.php'; ?>

<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container">
        <h2>Atualizar Manutenção</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="manutencao_id" value="<?php echo $row['manutencao_id']; ?>">
            <div class="mb-3">
                <label for="equipamento" class="form-label">Equipamento</label>
                <input type="text" class="form-control" id="equipamento" name="equipamento" value="<?php echo htmlspecialchars($row['equipamento']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao_problema" class="form-label">Descrição do Problema</label>
                <textarea class="form-control" id="descricao_problema" name="descricao_problema" rows="3" required><?php echo htmlspecialchars($row['descricao_problema']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="data_inicio" class="form-label">Data de Início</label>
                <input type="datetime-local" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo date('Y-m-d\TH:i', strtotime($row['data_inicio'])); ?>" required>
            </div>
            <div class="mb-3">
                <label for="data_termino" class="form-label">Data de Término</label>
                <input type="datetime-local" class="form-control" id="data_termino" name="data_termino" value="<?php echo date('Y-m-d\TH:i', strtotime($row['data_termino'])); ?>">
            </div>
            <div class="mb-3">
                <label for="responsavel_id" class="form-label">Técnico Responsável</label>
                <select class="form-select" id="responsavel_id" name="responsavel_id" required>
                    <?php
                    $tecnicos = $pdo->query("SELECT funcionario_id, nome FROM funcionarios")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($tecnicos as $tecnico) {
                        $selected = $tecnico['funcionario_id'] == $row['responsavel_id'] ? 'selected' : '';
                        echo "<option value='{$tecnico['funcionario_id']}' $selected>{$tecnico['nome']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="quebrado" <?php echo $row['status'] == 'quebrado' ? 'selected' : ''; ?>>Quebrado</option>
                    <option value="funcional" <?php echo $row['status'] == 'funcional' ? 'selected' : ''; ?>>Funcional</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>

    <?php include '../componentes/footer.php'; ?>