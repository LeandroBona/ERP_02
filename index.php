<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP - Tela Inicial</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/styles.css">
    <style>
        
        .container-modules {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            gap: 20px;
        }
        
        .module-card {
            width: 150px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #2980b9;
            color: #fff;
            text-align: center;
            border-radius: 10px;
            text-decoration: none;
            font-size: 1.2rem;
            transition: transform 0.2s, background-color 0.2s;
        }
        
        .module-card:hover {
            transform: scale(1.05);
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Bem-vindo ao ERP</h1>
        <div class="container-modules">
            <a href="telas/produtos/read.php" class="module-card">Produtos</a>
            <a href="telas/pedidos/read.php" class="module-card">Pedidos</a>
            <a href="telas/fornecedores/read.php" class="module-card">Fornecedores</a>
            <a href="telas/funcionarios/read.php" class="module-card">Funcionários</a>
            <a href="telas/estoque/estoque.php" class="module-card">Estoque</a>
            <a href="telas/equipamentos/read.php" class="module-card">Equipamentos</a>
        </div>
    </div>
    <?php include 'telas/componentes/footer.php'; ?>

