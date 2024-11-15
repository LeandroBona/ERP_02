<?php
// Conexão com o MySQL
$host = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'erp_sesi';  // Nome do banco de dados

try {
    // Conectar ao servidor MySQL e selecionar o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>
