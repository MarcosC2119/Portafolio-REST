<?php
// Ensure BASE_URL is defined for cURL
include_once __DIR__ . '/../../config.php'; // Include app/config.php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'app/controllers/auth/login.php');
    exit();
}
$id=intval($_GET['id']);

// --- INICIO DE CAMBIOS CLAVE ---
$data = [
    '_method' => 'DELETE', // Indicamos que es una eliminación
    'id'      => $id      // Pasamos el ID
];

// Usamos POST para enviar la petición
$ch=curl_init(BASE_URL . "api/proyectos.php");
curl_setopt_array($ch,[
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => http_build_query($data)
]);
// --- FIN DE CAMBIOS CLAVE ---

$response = curl_exec($ch);
curl_close($ch);

// Redirigir siempre al dashboard después de eliminar
header("Location: " . BASE_URL . "app/views/dashboard.php");
exit;
?>