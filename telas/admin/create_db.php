<?php
// Incluir o arquivo de conexão
include 'config.php';

// Caminho direto para o arquivo database.sql
$databaseFile = __DIR__ . '/database.sql';

try {
    // Ler o conteúdo do arquivo SQL
    $sql = file_get_contents($databaseFile);
    if ($sql === false) {
        throw new Exception("Não foi possível ler o arquivo SQL");
    }

    // Executar o script SQL
    $pdo->exec($sql);
    echo "Banco de dados criado ou atualizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro na execução do SQL: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
