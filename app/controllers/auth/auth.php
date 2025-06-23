/**
 * Verificación de Autenticación
 * 
 * Este archivo maneja la gestión de sesiones y verificación de autenticación.
 * Verifica si un usuario ha iniciado sesión y redirige a la página de login si no lo ha hecho.
 * 
 * @author Marcos Castro
 * @version 1.0
 */

<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}
?>