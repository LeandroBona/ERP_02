<?php
include '../admin/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['manutencao_id']; 
        $equipamento = $_POST['equipamento'];
        $descricao_problema = $_POST['descricao_problema'];
        $data_inicio = $_POST['data_inicio'];
        $data_termino = $_POST['data_termino'] ?? null;
        $responsavel_id = $_POST['responsavel_id']; 
        $status = $_POST['status'];

        $status_permitidos = ['quebrado', 'funcional'];
        if (!in_array($status, $status_permitidos)) {
            throw new Exception("Status inválido: $status");
        }

        $query = "UPDATE manutencoes 
                  SET equipamento = :equipamento, 
                      descricao_problema = :descricao_problema, 
                      data_inicio = :data_inicio, 
                      data_termino = :data_termino, 
                      responsavel_id = :responsavel_id, 
                      status = :status 
                  WHERE manutencao_id = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':equipamento', $equipamento);
        $stmt->bindParam(':descricao_problema', $descricao_problema);
        $stmt->bindParam(':data_inicio', $data_inicio);
        $stmt->bindParam(':data_termino', $data_termino);
        $stmt->bindParam(':responsavel_id', $responsavel_id);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

   
        if ($stmt->execute()) {
            header('Location: read.php');
            exit;
        } else {
            echo '<div class="alert alert-danger">Erro ao atualizar a manutenção.</div>';
        }
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Erro de banco de dados: ' . $e->getMessage() . '</div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
    }
}
?>
