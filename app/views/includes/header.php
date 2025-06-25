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
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111;
        }
    </style>
</head>
<body class="min-h-screen bg-black text-gray-100">
    <!-- Navbar -->
    <nav class="bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Menú izquierdo -->
                <div class="flex items-center space-x-8">
                    <a href="index.php" class="text-lg font-semibold text-yellow-500">Home</a>
                    <a href="#about" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">About</a>
                    <a href="#work" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Work</a>
                    <a href="#writing" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Writing</a>
                </div>
                <!-- Menú derecho -->
                <div class="flex items-center space-x-8">
                    <a href="#contact" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Contact</a>
                    <?php if(isset($_SESSION['user'])): ?>
                        <a href="<?= BASE_URL ?>dashboard" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Dashboard</a>
                        <a href="<?= BASE_URL ?>logout" class="text-lg font-medium text-red-400 hover:text-red-600 transition ml-4">Cerrar sesión</a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>login" class="text-lg font-medium text-yellow-500 hover:text-yellow-400 transition ml-4">Iniciar sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
<!-- CONTENIDO INICIA AQUÍ -->