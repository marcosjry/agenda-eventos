<?php
require_once __DIR__ .  '/middlewares/auth.php';
require_once __DIR__ .  '/config/database.php';
require_once __DIR__ .  '/includes/header.php';

$usuario_id = $_SESSION['usuario_id'];

// Buscar dados do usuário
$stmt = $pdo->prepare("SELECT nome, email, tipo FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header('Location: index.php');
    exit;
}

$erro = $_GET['erro'] ?? '';
$sucesso = $_GET['sucesso'] ?? '';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h3 fw-bold mb-4">Meu Perfil</h2>
                    
                    <?php if ($erro): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($erro) ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($sucesso): ?>
                        <div class="alert alert-success" role="alert">
                            Perfil atualizado com sucesso!
                        </div>
                    <?php endif; ?>

                    <form action="process_perfil.php" method="POST">
                        <div class="mb-3">
                            <label for="nome" class="form-label fw-semibold">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h5 class="h6 fw-bold mb-3">Alterar Senha (opcional)</h5>
                        <p class="text-muted small mb-3">Deixe em branco se não deseja alterar a senha</p>
                        
                        <div class="mb-3">
                            <label for="senha_atual" class="form-label fw-semibold">Senha Atual</label>
                            <input type="password" class="form-control" id="senha_atual" name="senha_atual">
                        </div>
                        
                        <div class="mb-3">
                            <label for="senha_nova" class="form-label fw-semibold">Nova Senha</label>
                            <input type="password" class="form-control" id="senha_nova" name="senha_nova">
                        </div>
                        
                        <div class="mb-4">
                            <label for="senha_confirma" class="form-label fw-semibold">Confirmar Nova Senha</label>
                            <input type="password" class="form-control" id="senha_confirma" name="senha_confirma">
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4 profile-btn-save">Salvar Alterações</button>
                            <a href="index.php" class="btn btn-outline-secondary px-4 profile-btn-cancel">Cancelar</a>
                        </div>
                    </form>
                    
                    <hr class="my-5">
                    
                    <div class="bg-light p-4 rounded-3 border border-danger">
                        <h5 class="h6 fw-bold text-danger mb-3">⚠️ Zona de Perigo</h5>
                        <p class="text-muted small mb-3">
                            <strong>ATENÇÃO:</strong> Ao excluir sua conta, todos os seus dados serão <strong>permanentemente removidos do banco de dados</strong>, incluindo suas inscrições em eventos. Esta ação <strong>não pode ser desfeita</strong>.
                        </p>
                        <a href="delete_account.php" class="btn btn-danger px-4 profile-btn-delete" onclick="return confirm('Digite OK para confirmar a exclusão permanente da sua conta')">>
                            🗑️ Excluir Permanentemente Minha Conta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
