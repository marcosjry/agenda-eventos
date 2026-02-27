<?php
require_once __DIR__ . '/events/list.php';
require_once __DIR__ . '/includes/header.php';
?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark">Próximos Eventos</h1>
        <p class="text-muted mx-auto" style="max-width: 700px;">
            Descubra workshops, palestras e conferências. Conecte-se com a comunidade e expanda seus conhecimentos.
        </p>
    </div>

    <!-- Barra de Busca -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 col-xl-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-0">
                    <form method="GET" action="index.php" id="formBusca">
                        <div class="d-flex align-items-stretch">
                            <!-- Dropdown de Filtro -->
                            <div class="dropdown">
                                <button class="btn btn-light border-end d-flex align-items-center gap-2 h-100 rounded-start-3" type="button" id="dropdownTipoBusca" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0.75rem 1.25rem; white-space: nowrap;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-funnel text-muted" viewBox="0 0 16 16">
                                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                                    </svg>
                                    <span id="textoTipoBusca" class="text-muted">
                                        <?php 
                                            $tipo = $_GET['tipo_busca'] ?? 'titulo';
                                            if ($tipo === 'data') echo 'Por Data';
                                            elseif ($tipo === 'descricao') echo 'Por Descrição';
                                            elseif ($tipo === 'titulo') echo 'Por Título';
                                            else echo 'Por Título';
                                        ?>
                                    </span>
                                </button>
                                <ul class="dropdown-menu shadow-sm" aria-labelledby="dropdownTipoBusca">
                                    <li><a class="dropdown-item <?= isset($_GET['tipo_busca']) && $_GET['tipo_busca'] === 'titulo' ? 'active' : '' ?>" href="#" data-tipo="titulo" data-texto="Por Título">Por Título</a></li>
                                    <li><a class="dropdown-item <?= isset($_GET['tipo_busca']) && $_GET['tipo_busca'] === 'descricao' ? 'active' : '' ?>" href="#" data-tipo="descricao" data-texto="Por Descrição">Por Descrição</a></li>
                                    <li><a class="dropdown-item <?= isset($_GET['tipo_busca']) && $_GET['tipo_busca'] === 'data' ? 'active' : '' ?>" href="#" data-tipo="data" data-texto="Por Data">Por Data</a></li>
                                </ul>
                                <input type="hidden" name="tipo_busca" id="tipo_busca" value="<?= htmlspecialchars($_GET['tipo_busca'] ?? 'titulo') ?>">
                            </div>
                            
                            <!-- Campo de Busca -->
                            <div class="flex-grow-1 position-relative">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search position-absolute text-muted" viewBox="0 0 16 16" style="left: 1rem; top: 50%; transform: translateY(-50%);">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                <input 
                                    type="text" 
                                    class="form-control border-0 shadow-none h-100" 
                                    id="termo_busca_texto" 
                                    name="termo_busca" 
                                    placeholder="Buscar evento..." 
                                    value="<?= (!isset($_GET['tipo_busca']) || $_GET['tipo_busca'] === 'titulo' || $_GET['tipo_busca'] === 'descricao') ? htmlspecialchars($_GET['termo_busca'] ?? '') : '' ?>"
                                    style="padding-left: 3rem; display: <?= (!isset($_GET['tipo_busca']) || $_GET['tipo_busca'] === '' || $_GET['tipo_busca'] === 'titulo' || $_GET['tipo_busca'] === 'descricao') ? 'block' : 'none' ?>;"
                                >
                                <input 
                                    type="date" 
                                    class="form-control border-0 shadow-none h-100" 
                                    id="termo_busca_data" 
                                    name="termo_busca_date" 
                                    value="<?= (isset($_GET['tipo_busca']) && $_GET['tipo_busca'] === 'data') ? htmlspecialchars($_GET['termo_busca'] ?? '') : '' ?>"
                                    style="padding-left: 3rem; display: <?= (isset($_GET['tipo_busca']) && $_GET['tipo_busca'] === 'data') ? 'block' : 'none' ?>;"
                                >
                            </div>
                            
                            <!-- Botão Buscar -->
                            <button type="submit" class="btn btn-primary border-0 rounded-end-3 px-4" style="font-weight: 500;">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php if (isset($_GET['tipo_busca']) && isset($_GET['termo_busca']) && $_GET['termo_busca'] !== ''): ?>
                <div class="d-flex justify-content-between align-items-center mt-3 px-2" id="feedback-busca">
                    <small class="text-muted" id="contagem-eventos">
                        <?php if (count($eventos) === 0): ?>
                            <span class="text-danger">Nenhum evento encontrado para "<strong><?= htmlspecialchars($_GET['termo_busca']) ?></strong>"</span>
                        <?php else: ?>
                            <span class="text-success"><?= count($eventos) ?> evento(s) encontrado(s)</span>
                        <?php endif; ?>
                    </small>
                    <button type="button" id="btnLimparBusca" class="btn btn-sm btn-outline-secondary rounded-pill px-3" style="font-weight: 500;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-x me-1" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        Limpar
                    </button>
                </div>
            <?php else: ?>
                <div class="d-flex justify-content-between align-items-center mt-3 px-2 d-none" id="feedback-busca">
                    <small class="text-muted" id="contagem-eventos"></small>
                    <button type="button" id="btnLimparBusca" class="btn btn-sm btn-outline-secondary rounded-pill px-3" style="font-weight: 500;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-x me-1" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        Limpar
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div id="status-carregamento" class="text-center d-none mb-4">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Carregando...</span>
        </div>
    </div>

    <?php if (count($eventos) === 0 && !isset($_GET['tipo_busca'])): ?>
        <div class="alert alert-info text-center" role="alert">
            Nenhum evento disponível no momento.
        </div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="lista-eventos">
        <?php foreach ($eventos as $evento): ?>
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

                        <a href="/evento.php?id=<?= $evento['id'] ?>" class="btn btn-outline-primary w-100 py-2" style="font-weight: 500;">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>