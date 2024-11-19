<?php

include '../admin/config.php';



if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];

    
    $sql = "DELETE FROM produtos WHERE produto_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$produto_id]);

    
    header('Location: read.php');
    exit;
} else {
    die("ID do produto não fornecido.");
}
?>
