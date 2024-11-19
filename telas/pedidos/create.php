<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);  

include '../admin/config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $categoria_id = $_POST['categoria_id'];

    
    $preco_venda = $_POST['preco_venda'];
    $preco_venda = str_replace("R$ ", "", $preco_venda); 
    $preco_venda = str_replace(".", "", $preco_venda);  
    $preco_venda = str_replace(",", ".", $preco_venda);  

    $preco_custo = $_POST['preco_custo'];
    $preco_custo = str_replace("R$ ", "", $preco_custo);  
    $preco_custo = str_replace(".", "", $preco_custo);  
    $preco_custo = str_replace(",", ".", $preco_custo);  

    $unidade_medida = $_POST['unidade_medida'];
    $fornecedor_id = $_POST['fornecedor_id'];

    try {
        $sql = "INSERT INTO produtos (nome, descricao, categoria_id, preco_venda, preco_custo, unidade_medida, fornecedor_id)
                VALUES (:nome, :descricao, :categoria_id, :preco_venda, :preco_custo, :unidade_medida, :fornecedor_id)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->bindParam(':preco_venda', $preco_venda);
        $stmt->bindParam(':preco_custo', $preco_custo);
        $stmt->bindParam(':unidade_medida', $unidade_medida);
        $stmt->bindParam(':fornecedor_id', $fornecedor_id);

        if ($stmt->execute()) {
            header("Location: read.php"); 
            exit;
        } else {
            echo "Erro ao cadastrar produto!";
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}
?>
