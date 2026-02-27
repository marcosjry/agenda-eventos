<?php
require_once __DIR__ . '/../middlewares/auth.php';
require_once __DIR__ . '/../config/database.php';

// Validar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /index.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$evento_id = $_POST['evento_id'] ?? null;

if (!$evento_id || !is_numeric($evento_id)) {
    $_SESSION['erro'] = 'Evento inválido';
    header('Location: /index.php');
    exit;
}

// Verificar se o usuário está realmente inscrito
$stmt = $pdo->prepare("
    SELECT id 
    FROM inscricoes 
    WHERE usuario_id = ? AND evento_id = ? AND status = 'INSCRITO'
");
$stmt->execute([$usuario_id, $evento_id]);
$inscricao = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$inscricao) {
    $_SESSION['erro'] = 'Você não está inscrito neste evento';
    header("Location: /evento.php?id=" . $evento_id);
    exit;
}

// Atualiza o status da inscrição para CANCELADO
$stmt = $pdo->prepare("
    UPDATE inscricoes 
    SET status = 'CANCELADO'
    WHERE id = ?
");

try {
    $stmt->execute([$inscricao['id']]);
    $_SESSION['sucesso'] = 'Sua inscrição foi cancelada com sucesso';
} catch (Exception $e) {
    $_SESSION['erro'] = 'Erro ao cancelar inscrição. Tente novamente.';
}

header("Location: /evento.php?id=" . $evento_id);
exit;
