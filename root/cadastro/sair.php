<?php
// Inicialize a sessão
session_start();

// Limpe todas as variáveis de sessão
$_SESSION = array();

// Destrua a sessão
session_destroy();

// Redirecione o usuário para a página de login ou para outra página desejada
header("Location: login.php");
exit();
?>
