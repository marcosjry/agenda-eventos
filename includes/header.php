<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuario_logado = isset($_SESSION['usuario_id']);
$is_admin = isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'ADM';



// Detectar a página atual para aplicar estilo ativo
$current_page = basename($_SERVER['PHP_SELF']);
$is_eventos = ($current_page === 'index.php' || $current_page === 'evento.php');
$is_login = ($current_page === 'login.php');
$is_register = ($current_page === 'register.php');
$is_admin_page = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false);
$is_profile_page = ($current_page === 'perfil.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/header.css">
    

</head>
<body class="bg-light">
    
    <header>
        <nav class="navbar navbar-expand-lg bg-white py-3 shadow-sm">
            <div class="container">
                
                <a class="navbar-brand d-flex align-items-center gap-2" href="/index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="<?= $cor_primaria ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bi bi-calendar" viewBox="0 0 16 16">
                        <rect x="2" y="3" width="12" height="11" rx="2" ry="2" fill="none"></rect>
                        <line x1="11" y1="1" x2="11" y2="3"></line>
                        <line x1="5" y1="1" x2="5" y2="3"></line>
                        <line x1="2" y1="7" x2="14" y2="7"></line>
                    </svg>
                    
                    <span class="fs-4 fw-bold">
                        <span class="text-dark">Agenda</span><span class="header-brand-eventos">Eventos</span>
                    </span>
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <div class="navbar-nav ms-auto align-items-center gap-3 mt-3 mt-lg-0">
                        
                        <a href="/index.php" class="btn-navigation <?= $is_eventos ? 'nav-btn-soft' : '' ?> px-3 py-2 rounded-3 border-0">
                            Eventos
                        </a>

                        <?php if ($usuario_logado): ?>
                            <?php if ($is_admin): ?>
                                <a href="/../admin/dashboard.php" class="btn-navigation <?= $is_admin_page ? 'nav-btn-soft' : '' ?> px-3 py-2 rounded-3 border-0">
                                    Painel Admin
                                </a>
                            <?php endif; ?>
                            

                            <a href="/perfil.php" class="btn-navigation <?= $is_profile_page ? 'nav-btn-soft' : '' ?> px-3 py-2 rounded-3 border-0">
                                Meu Perfil
                            </a>

                            <div class="vr d-none d-lg-block mx-2 text-secondary"></div>
                            
                            <span class="text-secondary small fw-medium">Olá, <?= htmlspecialchars(strtok($_SESSION['usuario_nome'], " ")) ?></span>
                            
                            <a href="/auth/logout.php" class="btn btn-clean-danger btn-sm px-3 rounded-pill">
                                Sair
                            </a>

                        <?php else: ?>
                            <a href="/login.php" class="btn <?= $is_login ? 'nav-btn-soft' : 'text-primary' ?> px-3 py-2 rounded-3 border-0">
                                Entrar
                            </a>

                            <a href="/register.php" class="btn nav-btn-primary px-4 py-2 rounded-3">
                                Cadastrar-se
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-4">