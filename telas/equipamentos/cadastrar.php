<?php
include '../admin/config.php';

$sql_funcionarios = "SELECT funcionario_id, nome FROM funcionarios"; 
$stmt_funcionarios = $pdo->query($sql_funcionarios);
$funcionarios = $stmt_funcionarios->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../componentes/head.php'; ?>

<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container mt-5">
        <h2>Cadastro de Manutenção</h2>
        <form action="create.php" method="POST">
            <div class="mb-3">
                <label for="equipamento" class="form-label">Equipamento:</label>
                <input type="text" class="form-control" id="equipamento" name="equipamento" required>
            </div>

            <div class="mb-3">
                <label for="descricao_problema" class="form-label">Descrição do Problema:</label>
                <textarea class="form-control" id="descricao_problema" name="descricao_problema" rows="3" required></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="data_inicio" class="form-label">Data de Início:</label>
                    <input type="datetime-local" class="form-control" id="data_inicio" name="data_inicio" required>
                </div>

                <div class="col-md-6">
                    <label for="data_termino" class="form-label">Data de Término:</label>
                    <input type="datetime-local" class="form-control" id="data_termino" name="data_termino">
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="responsavel_id" class="form-label">Técnico Responsável</label>
                <select class="form-control" id="responsavel_id" name="responsavel_id" required>
                    <option value="" disabled selected>Selecione o responsável</option>
                    <?php
                    foreach ($funcionarios as $tecnico) {
                        echo "<option value='{$tecnico['funcionario_id']}'>{$tecnico['nome']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="" disabled selected>Selecione o status</option>
                    <option value="quebrado">Quebrado</option>
                    <option value="funcional">Funcional</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar Manutenção</button>
        </form>
    </div>

    <?php include '../componentes/footer.php'; ?>

