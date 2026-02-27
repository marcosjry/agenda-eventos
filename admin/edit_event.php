<?php
require_once '../../middlewares/admin.php';
include '../../includes/header.php';
require_once '../../config/database.php';

$evento_id = $_GET['id'] ?? null;

if (!$evento_id) {
    header('Location: dashboard.php');
    exit;
}

// Buscar dados do evento
$stmt = $pdo->prepare("SELECT * FROM eventos WHERE id = ?");
$stmt->execute([$evento_id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    header('Location: dashboard.php');
    exit;
}

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $data_evento = $_POST['data_evento'] ?? '';
    $local = $_POST['local'] ?? '';
    $capacidade = $_POST['capacidade'] ?? '';
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    if ($titulo && $descricao && $data_evento && $local && $capacidade) {
        $stmt = $pdo->prepare("UPDATE eventos SET titulo = ?, descricao = ?, data_evento = ?, local = ?, capacidade_maxima = ?, ativo = ? WHERE id = ?");
        try {
            $stmt->execute([$titulo, $descricao, $data_evento, $local, $capacidade, $ativo, $evento_id]);
            $sucesso = "Evento atualizado com sucesso!";
            
            // Recarregar dados do evento
            $stmt = $pdo->prepare("SELECT * FROM eventos WHERE id = ?");
            $stmt->execute([$evento_id]);
            $evento = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $erro = "Erro ao atualizar evento: " . $e->getMessage();
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// Converter data para formato HTML datetime-local
$data_formatada = date('Y-m-d\TH:i', strtotime($evento['data_evento']));
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h3 fw-bold mb-4">Editar Evento</h2>
                    
                    <?php if ($erro): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($erro) ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($sucesso): ?>
                        <div class="alert alert-success" role="alert">
                            <?= htmlspecialchars($sucesso) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="titulo" class="form-label fw-semibold">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= htmlspecialchars($evento['titulo']) ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descricao" class="form-label fw-semibold">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="5" required><?= htmlspecialchars($evento['descricao']) ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="data_evento" class="form-label fw-semibold">Data e Hora</label>
                            <input type="datetime-local" class="form-control" id="data_evento" name="data_evento" value="<?= $data_formatada ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="local" class="form-label fw-semibold">Local</label>
                            <input type="text" class="form-control" id="local" name="local" value="<?= htmlspecialchars($evento['local']) ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="capacidade" class="form-label fw-semibold">Capacidade Máxima</label>
                            <input type="number" class="form-control" id="capacidade" name="capacidade" value="<?= $evento['capacidade_maxima'] ?>" required min="1">
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ativo" name="ativo" <?= $evento['ativo'] ? 'checked' : '' ?>>
                                <label class="form-check-label fw-semibold" for="ativo">
                                    Evento Ativo
                                </label>
                            </div>
                            <small class="text-muted">Desmarque para desativar o evento sem excluí-lo</small>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4" style="font-weight: 500;">Salvar Alterações</button>
                            <a href="dashboard.php" class="btn btn-outline-secondary px-4" style="font-weight: 500;">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
