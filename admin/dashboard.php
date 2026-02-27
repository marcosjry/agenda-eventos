<?php
require_once __DIR__ . '/../middlewares/admin.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../config/database.php';

// Buscar todos os eventos
$stmt = $pdo->query("SELECT id, titulo, data_evento, local, ativo FROM eventos ORDER BY data_evento DESC");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar todos os usuários (exceto o próprio admin logado)
$stmt = $pdo->prepare("SELECT id, nome, email, tipo, ativo FROM usuarios WHERE id != ?");
$stmt->execute([$_SESSION['usuario_id']]);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark">Painel de Administração</h1>
        <p class="text-muted">Gerencie eventos e usuários do sistema</p>
    </div>

    <!-- Gerenciar Eventos -->
    <div class="card border-0 shadow-sm rounded-3 mb-5">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 fw-bold mb-0">Gerenciar Eventos</h2>
                <a href="create_event.php" class="btn btn-primary px-4" style="font-weight: 500;">
                    <i class="bi bi-plus-circle me-1"></i> Novo Evento
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th>Data</th>
                            <th>Local</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($eventos)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Nenhum evento cadastrado.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($eventos as $e): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($e['titulo']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($e['data_evento'])) ?></td>
                                <td><?= htmlspecialchars($e['local']) ?></td>
                                <td>
                                    <?php if ($e['ativo']): ?>
                                        <span class="badge bg-success">Ativo</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="edit_event.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-outline-primary me-2" style="font-weight: 500;">
                                        Editar
                                    </a>
                                    <?php if ($e['ativo']): ?>
                                        <a href="toggle_event.php?id=<?= $e['id'] ?>&acao=desativar" class="btn btn-sm btn-outline-warning me-2" style="font-weight: 500;" onclick="return confirm('Deseja desativar este evento?')">
                                            Desativar
                                        </a>
                                    <?php else: ?>
                                        <a href="toggle_event.php?id=<?= $e['id'] ?>&acao=ativar" class="btn btn-sm btn-outline-success me-2" style="font-weight: 500;">
                                            Ativar
                                        </a>
                                    <?php endif; ?>
                                    <a href="permanent_delete_event.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-outline-danger" style="font-weight: 500;" onclick="return confirm('ATENÇÃO: Esta ação irá EXCLUIR PERMANENTEMENTE o evento e todas as inscrições. Deseja continuar?')">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Gerenciar Usuários -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            <h2 class="h4 fw-bold mb-4">Gerenciar Usuários</h2>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Tipo</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($usuarios)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Nenhum usuário cadastrado.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($u['nome']) ?></td>
                                <td><?= htmlspecialchars($u['email']) ?></td>
                                <td>
                                    <?php if ($u['tipo'] === 'ADM'): ?>
                                        <span class="badge bg-primary">Admin</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Usuário</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($u['ativo']): ?>
                                        <span class="badge bg-success">Ativo</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <?php if ($u['ativo']): ?>
                                        <a href="toggle_user.php?id=<?= $u['id'] ?>&acao=desativar" class="btn btn-sm btn-outline-warning me-2" style="font-weight: 500;" onclick="return confirm('Deseja desativar este usuário?')">
                                            Desativar
                                        </a>
                                    <?php else: ?>
                                        <a href="toggle_user.php?id=<?= $u['id'] ?>&acao=ativar" class="btn btn-sm btn-outline-success me-2" style="font-weight: 500;">
                                            Ativar
                                        </a>
                                    <?php endif; ?>
                                    <a href="permanent_delete_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-outline-danger" style="font-weight: 500;" onclick="return confirm('ATENÇÃO: Esta ação irá EXCLUIR PERMANENTEMENTE o usuário e todas as suas inscrições. Deseja continuar?')">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
