<?php
session_start();
// Incluir config para tener BASE_URL
include_once __DIR__ . '/../../config.php';

session_destroy();
// RUTA CORREGIDA: Usar la ruta completa desde BASE_URL
header("Location: " . BASE_URL . "app/controllers/auth/login.php");
exit();
?>