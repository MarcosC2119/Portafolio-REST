<?php
// Ensure BASE_URL is defined and session is started
include_once __DIR__ . '/../../config.php'; // Include app/config.php
session_start();

// Use BASE_URL for the absolute API endpoint
$json = file_get_contents(BASE_URL . 'api/proyectos.php');
$proyectos = json_decode($json, true);

// Define variables for header to indicate the context
$is_dashboard_page = true; // This is essentially the project management page, part of the dashboard
$is_auth_page = false;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proyectos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #111; color: #cbd5e0; }
    </style>
</head>
<body class="min-h-screen bg-black text-gray-100">
  <?php include __DIR__ . '/../../views/includes/header.php'; ?>
  <div class="max-w-5xl mx-auto py-12 px-4">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-white">Gestión de Proyectos</h1>
        <a href="add.php" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-4 py-2 rounded transition">+ Nuevo Proyecto</a>
    </div>

    <div id="proyectos" class="space-y-4">
    <?php if (empty($proyectos)): ?>
        <p class="text-gray-400">No hay proyectos para mostrar.</p>
    <?php else: ?>
        <?php foreach ($proyectos as $p): ?>
            <div class="bg-gray-900 rounded-lg p-6 flex flex-col md:flex-row items-center justify-between shadow-lg">
                <?php if ($p['imagen']): ?>
                    <img src="<?= BASE_URL ?>app/uploads/<?=htmlspecialchars($p['imagen'])?>" alt="<?=htmlspecialchars($p['titulo'])?>" class="w-32 h-32 object-cover rounded-lg mr-6 mb-4 md:mb-0 shadow">
                <?php endif; ?>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-white mb-1"><?=htmlspecialchars($p['titulo'])?></h3>
                    <p class="text-gray-300 mb-2"><?=htmlspecialchars($p['descripcion'])?></p>
                    <div class="flex flex-wrap gap-4 mb-2">
                        <?php if ($p['url_github']): ?>
                            <a href="<?=htmlspecialchars($p['url_github'])?>" target="_blank" class="text-yellow-500 hover:underline flex items-center"><i class='fab fa-github mr-2'></i> GitHub</a>
                        <?php endif; ?>
                        <?php if ($p['url_produccion']): ?>
                            <a href="<?=htmlspecialchars($p['url_produccion'])?>" target="_blank" class="text-yellow-500 hover:underline flex items-center"><i class='fas fa-external-link-alt mr-2'></i> Producción</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex flex-col space-y-2 ml-0 md:ml-6 mt-4 md:mt-0">
                    <a href="edit.php?id=<?=$p['id']?>" class="px-4 py-2 rounded bg-yellow-500 text-black font-semibold hover:bg-yellow-600 text-center transition">Editar</a>
                    <a href="delete.php?id=<?=$p['id']?>" onclick="return confirm('¿Seguro que deseas eliminar este proyecto?')" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 text-center transition">Eliminar</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
  </div>
  <?php include __DIR__ . '/../../views/includes/footer.php'; ?>
</body>
</html>