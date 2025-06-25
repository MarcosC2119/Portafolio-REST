<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include_once __DIR__ . '/../../config.php';

/**
 * Encabezado del Sitio
 *
 * Este archivo contiene el encabezado común para todas las páginas del sitio.
 * Características:
 * - Configuración básica del HTML y meta tags
 * - Inclusión de Tailwind CSS y Font Awesome
 * - Barra de navegación con menú de usuario
 * - Estilos base y fuentes personalizadas
 *
 * @author Marcos Castro
 * @version 1.0
 *
 * @param bool $is_dashboard_page Optional. Set to true if the current page is the dashboard.
 * @param bool $is_auth_page Optional. Set to true if the current page is a login/auth page.
 */

// Default values for context variables if not set by the including script
if (!isset($is_dashboard_page)) {
    $is_dashboard_page = false;
}
if (!isset($is_auth_page)) {
    $is_auth_page = false;
}

// Determine if we should show the "Inicio" link for public/auth/dashboard
$show_public_nav = !($is_dashboard_page || $is_auth_page); // Show public nav if not dashboard or auth page
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111;
        }
    </style>
</head>
<body class="min-h-screen bg-black text-gray-100 pt-16">
    <nav class="bg-black fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-8">
                    <?php if ($show_public_nav): ?>
                        <a href="<?= BASE_URL ?>" class="text-lg font-semibold text-yellow-500">Inicio</a>
                        <a href="#about" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Sobre Mí</a>
                        <a href="#skills" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Habilidades</a>
                        <a href="#work" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Proyectos</a>
                    <?php else: // If it's a dashboard or auth page, only show "Inicio" (which links to the public index) ?>
                        <a href="<?= BASE_URL ?>" class="text-lg font-semibold text-yellow-500">Inicio</a>
                    <?php endif; ?>
                </div>
                <div class="flex items-center space-x-8">
                    <?php if ($show_public_nav): ?>
                        <a href="#contact" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Contact</a>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['user'])): ?>
                        <a href="<?= BASE_URL ?>app/views/dashboard.php" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Dashboard</a>
                        <a href="<?= BASE_URL ?>app/controllers/auth/logout.php" class="text-lg font-medium text-red-400 hover:text-red-600 transition ml-4">Cerrar sesión</a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>app/controllers/auth/login.php" class="text-lg font-medium text-yellow-500 hover:text-yellow-400 transition ml-4">Iniciar sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>