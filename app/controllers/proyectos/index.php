<?php
// Ensure BASE_URL is defined
include_once __DIR__ . '/../../config.php'; // Include app/config.php

// Use BASE_URL for the absolute API endpoint
$json = file_get_contents(BASE_URL . 'api/proyectos.php');
$proyectos = json_decode($json, true);
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
        body { font-family: 'Inter', sans-serif; background-color: #1a202c; color: #cbd5e0; }
        .container { max-width: 800px; margin: 2rem auto; padding: 1.5rem; background-color: #2d3748; border-radius: 0.5rem; }
        h2 { font-size: 1.875rem; font-weight: 700; margin-bottom: 1.5rem; color: #fff; }
        .add-btn { background-color: #f6e05e; color: #2d3748; font-weight: 600; padding: 0.5rem 1rem; border-radius: 0.25rem; transition: background-color 0.2s ease-in-out; }
        .add-btn:hover { background-color: #edd13d; }
        .project-card { background-color: #1a202c; padding: 1.5rem; border-radius: 0.5rem; display: flex; gap: 1.5rem; margin-bottom: 1rem; align-items: center; }
        .project-card h3 { font-size: 1.25rem; font-weight: 700; color: #fff; margin-bottom: 0.5rem; }
        .project-card p { color: #a0aec0; margin-bottom: 0.5rem; }
        .project-card img { width: 100px; height: 100px; object-fit: cover; border-radius: 0.25rem; }
        .project-card .links a, .project-card .actions a { color: #f6e05e; margin-right: 1rem; text-decoration: none; }
        .project-card .actions a.delete { color: #fc8181; }
        .project-card .actions a:hover { text-decoration: underline; }
    </style>
</head>
<body>
  <div class="container">
    <div class="flex justify-between items-center mb-6">
        <h2>Proyectos</h2>
        <a href="add.php" class="add-btn">+ Agregar</a>
    </div>

    <?php if (empty($proyectos)): ?>
        <p class="text-gray-400">No hay proyectos para mostrar.</p>
    <?php else: ?>
        <?php foreach ($proyectos as $p): ?>
            <div class="project-card">
                <?php if ($p['imagen']): ?>
                    <img src="<?= BASE_URL ?>app/uploads/<?=htmlspecialchars($p['imagen'])?>" alt="<?=htmlspecialchars($p['titulo'])?>">
                <?php endif; ?>
                <div class="flex-1">
                    <h3><?=htmlspecialchars($p['titulo'])?></h3>
                    <p><?=htmlspecialchars($p['descripcion'])?></p>
                    <div class="links">
                        <?php if ($p['url_github']): ?>
                            <a href="<?=htmlspecialchars($p['url_github'])?>" target="_blank"><i class='fab fa-github'></i> GitHub</a>
                        <?php endif; ?>
                        <?php if ($p['url_produccion']): ?>
                            <a href="<?=htmlspecialchars($p['url_produccion'])?>" target="_blank"><i class='fas fa-external-link-alt'></i> En producción</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="actions">
                    <a href="edit.php?id=<?=$p['id']?>">Editar</a>
                    <a href="delete.php?id=<?=$p['id']?>" onclick="return confirm('¿Seguro que deseas eliminar este proyecto?')">Eliminar</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
  </div>
</body>
</html>