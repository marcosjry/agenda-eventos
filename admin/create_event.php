<?php
require_once '../../middlewares/admin.php';
include '../../includes/header.php';
require_once '../../config/database.php';

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $data_evento = $_POST['data_evento'] ?? '';
    $local = $_POST['local'] ?? '';
    $capacidade = $_POST['capacidade'] ?? '';
    $criado_por = $_SESSION['usuario_id'];

    if ($titulo && $descricao && $data_evento && $local && $capacidade) {
        $stmt = $pdo->prepare("INSERT INTO eventos (titulo, descricao, data_evento, local, capacidade_maxima, criado_por) VALUES (?, ?, ?, ?, ?, ?)");
        try {
            $stmt->execute([$titulo, $descricao, $data_evento, $local, $capacidade, $criado_por]);
            $sucesso = "Evento criado com sucesso!";
        } catch (Exception $e) {
            $erro = "Erro ao criar evento: " . $e->getMessage();
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h3 fw-bold mb-4">Criar Novo Evento</h2>
                    
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
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descricao" class="form-label fw-semibold">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="5" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="data_evento" class="form-label fw-semibold">Data e Hora</label>
                            <input type="datetime-local" class="form-control" id="data_evento" name="data_evento" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="local" class="form-label fw-semibold">Local</label>
                            <input type="text" class="form-control" id="local" name="local" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="capacidade" class="form-label fw-semibold">Capacidade Máxima</label>
                            <input type="number" class="form-control" id="capacidade" name="capacidade" required min="1">
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4" style="font-weight: 500;">Salvar Evento</button>
                            <a href="dashboard.php" class="btn btn-outline-secondary px-4" style="font-weight: 500;">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
