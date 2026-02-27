<?php

$host = 'sql204.infinityfree.com';
$dbname = 'if0_41125853_agenda_eventos';
$user = 'if0_41125853';
$pass = 'kWvIm7v0nKum3';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die('Erro na conexão com o banco de dados.');
}
