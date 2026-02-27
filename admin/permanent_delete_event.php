<?php
require_once '../../middlewares/admin.php';
require_once '../../config/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // Iniciar transação
        $pdo->beginTransaction();
        
        // Remover inscrições do evento
        $stmt = $pdo->prepare("DELETE FROM inscricoes WHERE evento_id = ?");
        $stmt->execute([$id]);
        
        // Remover o evento permanentemente
        $stmt = $pdo->prepare("DELETE FROM eventos WHERE id = ?");
        $stmt->execute([$id]);
        
        // Confirmar transação
        $pdo->commit();
    } catch (Exception $e) {
        // Reverter em caso de erro
        $pdo->rollBack();
    }
}

header('Location: dashboard.php');
exit;
