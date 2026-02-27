<?php
session_start();
require_once __DIR__ . '/config/database.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$stmt = $pdo->prepare("
    SELECT id, nome, senha, tipo
    FROM usuarios
    WHERE email = ? AND ativo = 1
");

$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    die('E-mail ou senha inválidos');
}

// cria sessão
$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];
$_SESSION['usuario_tipo'] = $usuario['tipo'];

echo 'Login realizado com sucesso';
