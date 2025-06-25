<?php
// Define la URL base de tu proyecto de forma explícita.
// MUY IMPORTANTE: Esta URL debe ser EXACTAMENTE la URL que utilizas en el navegador
// para acceder a la carpeta principal 'Portafolio-REST' de tu proyecto.
// Según tus ejemplos, debería ser esta:
define('BASE_URL', 'http://localhost/UCT/Portafolio-Final/Portafolio-REST/');

// Configuración de base de datos
$db_host = "localhost";
$db_name = "portafolio_db";
$db_user = "root";
$db_pass = "";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>