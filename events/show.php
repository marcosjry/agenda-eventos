<?php
require_once __DIR__ . '/../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('Evento inválido');
}

$stmt = $pdo->prepare("
    SELECT 
        e.id,
        e.titulo,
        e.descricao,
        e.data_evento,
        e.local,
        e.capacidade_maxima,
        (
            SELECT COUNT(*) 
            FROM inscricoes i 
            WHERE i.evento_id = e.id AND i.status = 'INSCRITO'
        ) AS total_inscritos
    FROM eventos e
    WHERE e.id = ? AND e.ativo = 1
");

$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    die('Evento não encontrado');
}
