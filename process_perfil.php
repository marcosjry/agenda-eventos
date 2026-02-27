<?php
require_once __DIR__ .  '/middlewares/auth.php';
require_once __DIR__ .  '/config/database.php';

$usuario_id = $_SESSION['usuario_id'];
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha_atual = $_POST['senha_atual'] ?? '';
$senha_nova = $_POST['senha_nova'] ?? '';
$senha_confirma = $_POST['senha_confirma'] ?? '';

if (!$nome || !$email) {
    header('Location: perfil.php?erro=Preencha todos os campos obrigatórios');
    exit;
}

// Verificar se o email já existe para outro usuário
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
$stmt->execute([$email, $usuario_id]);

if ($stmt->fetch()) {
    header('Location: perfil.php?erro=E-mail já cadastrado por outro usuário');
    exit;
}

// Se está tentando alterar a senha
if ($senha_atual || $senha_nova || $senha_confirma) {
    if (!$senha_atual || !$senha_nova || !$senha_confirma) {
        header('Location: perfil.php?erro=Preencha todos os campos de senha para alterá-la');
        exit;
    }
    
    if ($senha_nova !== $senha_confirma) {
        header('Location: perfil.php?erro=As senhas não coincidem');
        exit;
    }
    
    // Verificar senha atual
    $stmt = $pdo->prepare("SELECT senha FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!password_verify($senha_atual, $usuario['senha'])) {
        header('Location: perfil.php?erro=Senha atual incorreta');
        exit;
    }
    
    // Atualizar com nova senha
    $hash = password_hash($senha_nova, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $hash, $usuario_id]);
} else {
    // Atualizar apenas nome e email
    $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $usuario_id]);
}

// Atualizar nome na sessão
$_SESSION['usuario_nome'] = $nome;

header('Location: perfil.php?sucesso=1');
exit;
