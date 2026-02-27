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

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Retornar HTML dos eventos
    if (count($eventos) > 0) {
        foreach ($eventos as $evento) {
            ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="position-relative d-flex align-items-center justify-content-center" style="height: 160px; background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);">
                        <span class="badge bg-white text-success position-absolute top-0 end-0 m-3 shadow-sm rounded-pill px-3 py-2" style="font-weight: 500;">
                            Vagas Abertas
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-calendar text-primary opacity-25" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                        </svg>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-primary fw-bold small mb-2">
                            <?= date('d/m/Y', strtotime($evento['data_evento'])) ?>
                        </p>
                        <h5 class="card-title fw-bold mb-3"><?= htmlspecialchars($evento['titulo']) ?></h5>
                        <p class="card-text text-muted small mb-4">
                            <?= htmlspecialchars(mb_strimwidth($evento['descricao'], 0, 90, "...")) ?>
                        </p>
                        <div class="d-flex align-items-center text-muted small mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-geo-alt-fill me-2" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                            <span><?= htmlspecialchars($evento['local']) ?></span>
                        </div>
                        <a href="./evento.php?id=<?= $evento['id'] ?>" class="btn btn-outline-primary w-100 py-2" style="font-weight: 500;">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
} catch (Exception $e) {
    echo '<div class="col-12"><div class="alert alert-danger text-center">Erro ao buscar eventos</div></div>';
}