<?php
require_once __DIR__ . '/../config/database.php';

// Capturar parâmetros de busca
$tipo_busca = $_GET['tipo_busca'] ?? '';
$termo_busca = $_GET['termo_busca'] ?? '';

$query = "
    SELECT 
        id,
        titulo,
        descricao,
        data_evento,
        local,
        capacidade_maxima
    FROM eventos
    WHERE ativo = 1
";

$params = [];

// Aplicar filtros de busca
if ($tipo_busca && $termo_busca !== '') {
    if ($tipo_busca === 'titulo') {
        $query .= " AND titulo LIKE ?";
        $params[] = "%$termo_busca%";
    } elseif ($tipo_busca === 'descricao') {
        $query .= " AND descricao LIKE ?";
        $params[] = "%$termo_busca%";
    } elseif ($tipo_busca === 'data') {
        $query .= " AND DATE(data_evento) = ?";
        $params[] = $termo_busca;
    }
}

$query .= " ORDER BY data_evento ASC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
