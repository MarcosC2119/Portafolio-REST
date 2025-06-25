<?php
// Ensure BASE_URL is defined for cURL and file paths
include_once __DIR__ . '/../../config.php'; // Include app/config.php

$id=intval($_GET['id']);
// La petición inicial para obtener datos no cambia, sigue siendo GET
$json=file_get_contents(BASE_URL . "api/proyectos.php?id=$id");
$p=json_decode($json,true);

if ($_SERVER['REQUEST_METHOD']=='POST') {
  $data = [
    '_method' => 'PATCH', // --- CAMBIO CLAVE: Indicamos que es una actualización ---
    'id' => $id, // Pasamos el ID en el cuerpo de la petición
    'titulo'=>$_POST['titulo'],
    'descripcion'=>$_POST['descripcion'],
    'url_github'=>$_POST['url_github'],
    'url_produccion'=>$_POST['url_produccion']
  ];
  if (!empty($_FILES['imagen']['name'])) {
    $img=$_FILES['imagen']['name'];
    $upload_dir = __DIR__ . '/../../uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    move_uploaded_file($_FILES['imagen']['tmp_name'], $upload_dir . $img);
    $data['imagen']=$img;
  }

  // --- CAMBIO CLAVE: Usamos POST en lugar de PATCH ---
  $ch=curl_init(BASE_URL . "api/proyectos.php");
  curl_setopt_array($ch,[
    CURLOPT_POST => true, // Usamos POST
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => http_build_query($data) // Enviamos datos como application/x-www-form-urlencoded
  ]);
  curl_exec($ch);
  curl_close($ch);
  header("Location: " . BASE_URL . "app/views/dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #111; color: #cbd5e0; }
    </style>
</head>
<body class="min-h-screen bg-black text-gray-100">
  <?php include __DIR__ . '/../../views/includes/header.php'; ?>
  <div class="max-w-xl mx-auto py-12 px-4">
    <div class="bg-gray-900 p-8 rounded-lg shadow-xl">
        <h2 class="text-3xl font-bold text-white mb-6 text-center">Editar: <?=htmlspecialchars($p['titulo'])?></h2>
        <form method="post" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label for="titulo" class="block text-gray-300 text-lg font-semibold mb-2">Título</label>
                <input type="text" name="titulo" id="titulo" value="<?=htmlspecialchars($p['titulo'])?>" required
                       class="w-full px-4 py-2 rounded-md bg-gray-800 text-white border border-gray-700 focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
            </div>
            <div>
                <label for="descripcion" class="block text-gray-300 text-lg font-semibold mb-2">Descripción</label>
                <textarea name="descripcion" id="descripcion"
                          class="w-full px-4 py-2 rounded-md bg-gray-800 text-white border border-gray-700 focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 h-32"><?=htmlspecialchars($p['descripcion'])?></textarea>
            </div>
            <div>
                <label for="url_github" class="block text-gray-300 text-lg font-semibold mb-2">URL GitHub</label>
                <input type="url" name="url_github" id="url_github" value="<?=htmlspecialchars($p['url_github'])?>"
                       class="w-full px-4 py-2 rounded-md bg-gray-800 text-white border border-gray-700 focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
            </div>
            <div>
                <label for="url_produccion" class="block text-gray-300 text-lg font-semibold mb-2">URL Producción</label>
                <input type="url" name="url_produccion" id="url_produccion" value="<?=htmlspecialchars($p['url_produccion'])?>"
                       class="w-full px-4 py-2 rounded-md bg-gray-800 text-white border border-gray-700 focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
            </div>
            <div>
                <label for="imagen" class="block text-gray-300 text-lg font-semibold mb-2">Imagen (actual: <?=$p['imagen'] ? htmlspecialchars($p['imagen']) : 'Ninguna'?>)</label>
                <input type="file" name="imagen" id="imagen"
                       class="w-full text-white bg-gray-800 border border-gray-700 rounded-md py-2 px-4 focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-500 file:text-black hover:file:bg-yellow-600">
                <?php if ($p['imagen']): ?>
                    <img src="<?= BASE_URL ?>app/uploads/<?=htmlspecialchars($p['imagen'])?>" alt="Imagen actual" class="mt-4 rounded-md shadow-md mx-auto" style="max-width: 200px; height: auto;">
                <?php endif; ?>
            </div>
            <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent text-lg font-medium rounded-md text-black bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-300 ease-in-out">
                Actualizar Proyecto
            </button>
        </form>
    </div>
  </div>
  <?php include __DIR__ . '/../../views/includes/footer.php'; ?>
</body>
</html>