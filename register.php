<?php
require_once __DIR__ . '/includes/header.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$erro = $_GET['erro'] ?? '';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h3 fw-bold text-center mb-4">Criar Conta</h2>

                    <?php if ($erro): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($erro) ?>
                        </div>
                    <?php endif; ?>

                    <form action="process_register.php" method="POST" novalidate>
                        <div class="mb-3">
                            <label for="nome" class="form-label fw-semibold">Nome Completo</label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="mb-4">
                            <label for="senha" class="form-label fw-semibold">Senha</label>
                            <input type="password" class="form-control" name="senha" id="senha" required>
                            <small class="text-muted">Mínimo de 8 caracteres</small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 auth-btn-submit">Cadastrar</button>
                    </form>
                    <p class="text-center text-muted mt-4 mb-0">
                        Já tem uma conta? <a href="login.php" class="text-decoration-none fw-semibold">Faça login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/validations.js"></script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
