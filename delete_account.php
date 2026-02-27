<?php
require_once __DIR__.'/middlewares/auth.php';
require_once __DIR__. '/config/database.php';

$usuario_id = $_SESSION['usuario_id'];

try {
    // Iniciar transação
    $pdo->beginTransaction();
    
    // Remover todas as inscrições do usuário
    $stmt = $pdo->prepare("DELETE FROM inscricoes WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);
    
    // Remover o usuário permanentemente do banco de dados
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    
    // Confirmar transação
    $pdo->commit();
    
    // Fazer logout
    session_destroy();
    
    header('Location: login.php?sucesso=Conta excluída com sucesso');
    exit;
} catch (Exception $e) {
    // Reverter em caso de erro
    $pdo->rollBack();
    header('Location: perfil.php?erro=Erro ao excluir conta');
    exit;
}
