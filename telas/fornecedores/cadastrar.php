<?php include '../componentes/head.php'; ?>
<body>
    <?php include '../componentes/navbar.php'; ?>
    <div class="container">
        <h2 class="mt-4 text-center">Cadastrar Fornecedor</h2>
        <form action="create.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Fornecedor" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone do Fornecedor" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email do Fornecedor" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço do Fornecedor" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
        </form>
    </div>

    <?php include '../componentes/footer.php'; ?>