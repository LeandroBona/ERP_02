<?php
// Conexão com o MySQL
$host = 'localhost';
$user = 'root';
$password = 'root';
// ao invés de colocar o nome do banco
// apontar par ao arquivo database.sql, e o banco será criado automaticamente 
$databaseFile = 'database.sql';

try {
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ler o conteúdo do arquivo SQL
    $sql = file_get_contents($databaseFile);
    if ($sql === false) {
        throw new Exception("Não foi possível ler o arquivo SQL");
    }

    // Executar o script SQL
    $pdo->exec($sql);
    echo "Banco de dados criado ou atualizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
