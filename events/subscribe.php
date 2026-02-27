<?php
require_once __DIR__ . '/../middlewares/auth.php';
require_once __DIR__ . '/../config/database.php';

$usuario_id = $_SESSION['usuario_id'];
$evento_id = $_POST['evento_id'] ?? null;

if (!$evento_id) {
    $_SESSION['erro'] = 'Evento inválido';
    header('Location: /index.php');
    exit;
}

// Verifica se já existe alguma inscrição (ativa ou cancelada)
$stmt = $pdo->prepare("
    SELECT id, status 
    FROM inscricoes 
    WHERE usuario_id = ? AND evento_id = ?
");
$stmt->execute([$usuario_id, $evento_id]);
$inscricao_existente = $stmt->fetch(PDO::FETCH_ASSOC);

// Se já está inscrito com status INSCRITO
if ($inscricao_existente && $inscricao_existente['status'] === 'INSCRITO') {
    $_SESSION['erro'] = 'Você já está inscrito neste evento';
    header("Location: /evento.php?id=$evento_id");
    exit;
}

// Verifica vagas disponíveis
$stmt = $pdo->prepare("
    SELECT 
        capacidade_maxima,
        (
            SELECT COUNT(*) 
            FROM inscricoes 
            WHERE evento_id = ? AND status = 'INSCRITO'
        ) AS total
    FROM eventos
    WHERE id = ? AND ativo = 1
");
$stmt->execute([$evento_id, $evento_id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento || $evento['total'] >= $evento['capacidade_maxima']) {
    $_SESSION['erro'] = 'Evento lotado ou inválido';
    header("Location: /evento.php?id=$evento_id");
    exit;
}

// Se já existe uma inscrição CANCELADA, reativa ela
if ($inscricao_existente && $inscricao_existente['status'] === 'CANCELADO') {
    $stmt = $pdo->prepare("
        UPDATE inscricoes 
        SET status = 'INSCRITO'
        WHERE id = ?
    ");
    $stmt->execute([$inscricao_existente['id']]);
} else {
    // Caso contrário, insere nova inscrição
    $stmt = $pdo->prepare("
        INSERT INTO inscricoes (usuario_id, evento_id, status)
        VALUES (?, ?, 'INSCRITO')
    ");
    $stmt->execute([$usuario_id, $evento_id]);
}

$_SESSION['sucesso'] = 'Inscrição realizada com sucesso!';
header("Location: /evento.php?id=$evento_id");
exit;
