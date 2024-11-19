
    <nav class="col-md-2 sidebar">
        <div class="logo">
            <h2 class="text-center text-white">
                <a href="../../index.php">Logo do Cliente</a>
            </h2>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="toggleMenu('produtos')">Produtos</a>
                <ul id="produtos" class="sub-menu">
                    <li><a href="../produtos/cadastrar.php">Cadastrar Produto</a></li>
                    <li><a href="../produtos/read.php">Listar Produtos</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="toggleMenu('pedidos')">Pedidos</a>
                <ul id="pedidos" class="sub-menu">
                    <li><a href="../pedidos/cadastrar.php">Realizar Pedido</a></li>
                    <li><a href="../pedidos/read.php">Listar Pedidos</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="toggleMenu('fornecedores')">Fornecedores</a>
                <ul id="fornecedores" class="sub-menu">
                    <li><a href="../fornecedores/cadastrar.php">Cadastrar Fornecedor</a></li>
                    <li><a href="../fornecedores/read.php">Listar Fornecedores</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="toggleMenu('funcionarios')">Funcionários</a>
                <ul id="funcionarios" class="sub-menu">
                    <li><a href="../funcionarios/cadastrar.php">Cadastrar Funcionários</a></li>
                    <li><a href="../funcionarios/read.php">Listar Funcionários</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="toggleMenu('estoque')">Estoque</a>
                <ul id="estoque" class="sub-menu">
                    <li><a href="../estoque/estoque.php">Visualizar Estoque</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="toggleMenu('equipamentos')">Equipamentos</a>
                <ul id="equipamentos" class="sub-menu">
                    <li><a href="../equipamentos/cadastrar.php">Registrar Equipamentos</a></li>
                    <li><a href="../equipamentos/read.php">Listar Equipamentos</a></li>
                </ul>
            </li>
        </ul>
    </nav>