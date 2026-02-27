<?php
session_start();
require_once __DIR__ . '/config/database.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!$email || !$senha) {
    header('Location: login.php?erro=Preencha todos os campos');
    exit;
}

$stmt = $pdo->prepare("SELECT id, nome, senha, tipo FROM usuarios WHERE email = ? AND ativo = 1");
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    header('Location: login.php?erro=E-mail ou senha inválidos');
    exit;
}

$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];
$_SESSION['usuario_tipo'] = $usuario['tipo'];

header('Location: index.php');
exit;
