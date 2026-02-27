<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/events/show.php';

$logado = isset($_SESSION['usuario_id']);
$vagas_disponiveis = $evento['capacidade_maxima'] - $evento['total_inscritos'];

// Verificar se o usuário já está inscrito
$esta_inscrito = false;
if ($logado) {
    $stmt = $pdo->prepare("SELECT id FROM inscricoes WHERE usuario_id = ? AND evento_id = ? AND status = 'INSCRITO'");
    $stmt->execute([$_SESSION['usuario_id'], $evento['id']]);
    $esta_inscrito = (bool)$stmt->fetch();
}

// Mensagens de feedback
$sucesso = $_SESSION['sucesso'] ?? null;
$erro = $_SESSION['erro'] ?? null;
unset($_SESSION['sucesso'], $_SESSION['erro']);
?>

<div class="container py-5">
    
    <a href="/index.php" class="text-decoration-none text-secondary mb-4 d-inline-block">
        &larr; Voltar para eventos
    </a>

    <?php if ($sucesso): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <?= htmlspecialchars($sucesso) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($erro): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <?= htmlspecialchars($erro) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm overflow-hidden rounded-3">
        
        <div class="p-5 text-white" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
            <div class="mb-2 opacity-75 small">
                <?= date('d/m/Y', strtotime($evento['data_evento'])) ?> • <?= date('H:i', strtotime($evento['data_evento'])) ?>
            </div>
            <h1 class="fw-bold display-5"><?= htmlspecialchars($evento['titulo']) ?></h1>
        </div>

        <div class="card-body p-4 p-md-5">
            <div class="row g-5">
                
                <div class="col-lg-8">
                    <h5 class="fw-bold mb-3">Sobre o evento</h5>
                    <p class="text-muted mb-5" style="line-height: 1.6;">
                        <?= nl2br(htmlspecialchars($evento['descricao'])) ?>
                    </p>

                    <h5 class="fw-bold mb-3">Detalhes</h5>
                    <div class="d-flex flex-column gap-3 text-muted">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-geo-alt text-primary me-3" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            <span><?= htmlspecialchars($evento['local']) ?></span>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people text-primary me-3" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0z"/>
                            </svg>
                            <span>Capacidade: <?= $evento['capacidade_maxima'] ?> pessoas</span>
                        </div>

                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle text-primary me-3" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                            <span>Disponível: <?= $vagas_disponiveis ?> vagas</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-light p-4 rounded-3 border">
                        <h5 class="fw-bold mb-3">Inscrição</h5>
                        
                        <?php if (!$logado): ?>
                            <p class="text-muted small mb-3">Você precisa estar logado para garantir sua vaga.</p>
                            <a href="/login.php" class="btn btn-primary w-100 py-2" style="font-weight: 500;">
                                Fazer Login
                            </a>
                        
                        <?php elseif ($esta_inscrito): ?>
                            <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                <div>Você já está inscrito!</div>
                            </div>
                            
                            <p class="text-muted small mb-3">Deseja cancelar sua inscrição neste evento?</p>
                            <form action="/events/unsubscribe.php" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar sua inscrição?');">
                                <input type="hidden" name="evento_id" value="<?= $evento['id'] ?>">
                                <button type="submit" class="btn btn-outline-danger w-100 py-2" style="font-weight: 500;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle me-1" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                    Cancelar Inscrição
                                </button>
                            </form>

                        <?php elseif ($vagas_disponiveis <= 0): ?>
                            <div class="alert alert-danger" role="alert">
                                Desculpe, este evento está lotado.
                            </div>

                        <?php else: ?>
                            <p class="text-muted small mb-3">Garanta sua vaga agora clicando abaixo.</p>
                            <form action="/events/subscribe.php" method="POST">
                                <input type="hidden" name="evento_id" value="<?= $evento['id'] ?>">
                                <button type="submit" class="btn btn-primary w-100 py-2" style="font-weight: 500;">
                                    Confirmar Inscrição
                                </button>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>