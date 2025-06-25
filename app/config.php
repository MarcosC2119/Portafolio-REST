<?php
// Define la URL base de tu proyecto de forma explícita.
// MUY IMPORTANTE: Esta URL debe ser EXACTAMENTE la URL que utilizas en el navegador
// para acceder a la carpeta principal 'Portafolio-REST' de tu proyecto.
// Según tus ejemplos, debería ser esta:
define('BASE_URL', 'https://teclab.uct.cl/~marcos.castro/Portafolio-REST/');

// Configuración de base de datos
$db_host = "localhost";
$db_name = "marcos_castro_db1";
$db_user = "marcos_castro";
$db_pass = "marcos_castro2025";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>