<?php
session_start();
require_once 'config.php';

session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destroi a sessão

header("Location: " . BASE_URL . "/pages/home.php");
exit();