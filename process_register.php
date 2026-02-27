<?php
session_start();
require_once __DIR__ . '/config/database.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!$nome || !$email || !$senha) {
    header('Location: register.php?erro=Preencha todos os campos');
    exit;
}

// verifica se email já existe
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    header('Location: register.php?erro=E-mail já cadastrado');
    exit;
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
try {
    $stmt->execute([$nome, $email, $hash]);
    header('Location: login.php?sucesso=1');
} catch (Exception $e) {
    header('Location: register.php?erro=Erro ao cadastrar usuário');
}
exit;
