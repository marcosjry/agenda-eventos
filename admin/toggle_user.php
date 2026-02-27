<?php
require_once '../../middlewares/admin.php';
require_once '../../config/database.php';

$id = $_GET['id'] ?? null;
$acao = $_GET['acao'] ?? null;

if ($id && $acao) {
    if ($acao === 'ativar') {
        $stmt = $pdo->prepare("UPDATE usuarios SET ativo = 1 WHERE id = ?");
        $stmt->execute([$id]);
    } elseif ($acao === 'desativar') {
        $stmt = $pdo->prepare("UPDATE usuarios SET ativo = 0 WHERE id = ?");
        $stmt->execute([$id]);
    }
}

header('Location: dashboard.php');
exit;
