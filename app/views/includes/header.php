<?php
if (session_status() === PHP_SESSION_NONE) session_start();
// Asegúrate de que BASE_URL esté definido
if (file_exists(__DIR__ . '/../../config.php')) {
    include_once __DIR__ . '/../../config.php';
}

// Valores por defecto para las variables de contexto
$is_dashboard_page = isset($is_dashboard_page) ? $is_dashboard_page : false;
$is_auth_page = isset($is_auth_page) ? $is_auth_page : false;

$show_public_nav = !($is_dashboard_page || $is_auth_page);
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
<body class="min-h-screen bg-black text-gray-100 pt-20">
    <nav class="bg-black fixed top-0 left-0 w-full z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="<?= BASE_URL ?>" class="text-xl font-bold text-yellow-500">Mi Portafolio</a>
                </div>

                <div class="hidden md:flex md:items-center md:space-x-8">
                    <?php if ($show_public_nav): ?>
                        <a href="#about" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Sobre Mí</a>
                        <a href="#skills" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Habilidades</a>
                        <a href="#work" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Proyectos</a>
                        <a href="#contact" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Contacto</a>
                    <?php endif; ?>
                    
                    <?php if(isset($_SESSION['user'])): ?>
                        <a href="<?= BASE_URL ?>app/views/dashboard.php" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Dashboard</a>
                        <a href="<?= BASE_URL ?>app/controllers/auth/logout.php" class="text-lg font-medium text-red-400 hover:text-red-600 transition">Cerrar sesión</a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>app/controllers/auth/login.php" class="text-lg font-medium text-yellow-500 hover:text-yellow-400 transition">Iniciar sesión</a>
                    <?php endif; ?>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Abrir menú principal</span>
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                 <?php if ($show_public_nav): ?>
                    <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-200 hover:text-yellow-500 hover:bg-gray-700">Sobre Mí</a>
                    <a href="#skills" class="block px-3 py-2 rounded-md text-base font-medium text-gray-200 hover:text-yellow-500 hover:bg-gray-700">Habilidades</a>
                    <a href="#work" class="block px-3 py-2 rounded-md text-base font-medium text-gray-200 hover:text-yellow-500 hover:bg-gray-700">Proyectos</a>
                    <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-gray-200 hover:text-yellow-500 hover:bg-gray-700">Contacto</a>
                <?php endif; ?>
                
                <div class="border-t border-gray-700 my-2"></div>

                <?php if(isset($_SESSION['user'])): ?>
                    <a href="<?= BASE_URL ?>app/views/dashboard.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-200 hover:text-yellow-500 hover:bg-gray-700">Dashboard</a>
                    <a href="<?= BASE_URL ?>app/controllers/auth/logout.php" class="block px-3 py-2 rounded-md text-base font-medium text-red-400 hover:text-red-600 hover:bg-gray-700">Cerrar sesión</a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>app/controllers/auth/login.php" class="block px-3 py-2 rounded-md text-base font-medium text-yellow-500 hover:text-yellow-400 hover:bg-gray-700">Iniciar sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>