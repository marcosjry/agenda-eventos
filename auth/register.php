<?php
require_once __DIR__ . '/../config/database.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!$nome || !$email || !$senha) {
    die('Dados inválidos');
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

// verifica se email já existe
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    die('E-mail já cadastrado');
}

// insere usuário
$stmt = $pdo->prepare("
    INSERT INTO usuarios (nome, email, senha)
    VALUES (?, ?, ?)
");

$stmt->execute([$nome, $email, $hash]);

echo 'Usuário cadastrado com sucesso';
