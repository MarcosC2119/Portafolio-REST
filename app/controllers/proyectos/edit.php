<?php
// Ensure BASE_URL is defined for cURL and file paths
include_once __DIR__ . '/../../config.php'; // Include app/config.php

$id=intval($_GET['id']);
// Use BASE_URL for the absolute API endpoint
$json=file_get_contents(BASE_URL . "api/proyectos.php/$id");
$p=json_decode($json,true);

if ($_SERVER['REQUEST_METHOD']=='POST') {
  $data = [
    'titulo'=>$_POST['titulo'],
    'descripcion'=>$_POST['descripcion'],
    'url_github'=>$_POST['url_github'],
    'url_produccion'=>$_POST['url_produccion']
  ];
  if (!empty($_FILES['imagen']['name'])) {
    $img=$_FILES['imagen']['name'];
    // Correct path for uploading images to app/uploads/
    $upload_dir = __DIR__ . '/../../uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true); // Create directory if it doesn't exist
    }
    move_uploaded_file($_FILES['imagen']['tmp_name'], $upload_dir . $img);
    $data['imagen']=$img;
  }
  // Use BASE_URL for the absolute API endpoint
  $ch=curl_init(BASE_URL . "api/proyectos.php/$id");
  curl_setopt_array($ch,[
    CURLOPT_CUSTOMREQUEST=>'PATCH',
    CURLOPT_HTTPHEADER=>['Content-Type: application/json'],
    CURLOPT_RETURNTRANSFER=>true,
    CURLOPT_POSTFIELDS=>json_encode($data)
  ]);
  curl_exec($ch);
  curl_close($ch);
  header("Location: index.php"); // This relative path is fine
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
        body { font-family: 'Inter', sans-serif; background-color: #1a202c; color: #cbd5e0; }
        .container { max-width: 600px; margin: 2rem auto; padding: 1.5rem; background-color: #2d3748; border-radius: 0.5rem; }
        h2 { font-size: 1.875rem; font-weight: 700; margin-bottom: 1.5rem; color: #fff; }
        form div { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; color: #a0aec0; }
        input[type="text"], input[type="url"], textarea, input[type="file"] {
            width: 100%; padding: 0.75rem; border-radius: 0.25rem; border: 1px solid #4a5568; background-color: #2d3748; color: #fff;
        }
        textarea { min-height: 100px; resize: vertical; }
        button {
            background-color: #f6e05e; color: #2d3748; font-weight: 600; padding: 0.75rem 1.5rem; border-radius: 0.25rem;
            cursor: pointer; transition: background-color 0.2s ease-in-out;
        }
        button:hover { background-color: #edd13d; }
        img { display: block; max-width: 150px; height: auto; margin-top: 1rem; border-radius: 0.25rem; }
    </style>
</head>
<body>
  <div class="container">
    <h2>Editar: <?=htmlspecialchars($p['titulo'])?></h2>
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" value="<?=htmlspecialchars($p['titulo'])?>" required>
        </div>
        <div>
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion"><?=htmlspecialchars($p['descripcion'])?></textarea>
        </div>
        <div>
            <label for="url_github">URL GitHub</label>
            <input type="url" name="url_github" id="url_github" value="<?=htmlspecialchars($p['url_github'])?>">
        </div>
        <div>
            <label for="url_produccion">URL Producción</label>
            <input type="url" name="url_produccion" id="url_produccion" value="<?=htmlspecialchars($p['url_produccion'])?>">
        </div>
        <div>
            <label for="imagen">Imagen (actual: <?=$p['imagen'] ? htmlspecialchars($p['imagen']) : 'Ninguna'?>)</label>
            <input type="file" name="imagen" id="imagen">
            <?php if ($p['imagen']): ?>
                <img src="<?= BASE_URL ?>app/uploads/<?=htmlspecialchars($p['imagen'])?>" alt="Imagen actual">
            <?php endif; ?>
        </div>
        <button type="submit">Actualizar</button>
    </form>
  </div>
</body>
</html>