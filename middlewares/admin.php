<?php
require_once 'auth.php';

if ($_SESSION['usuario_tipo'] !== 'ADM') {
    die('Acesso negado');
}
