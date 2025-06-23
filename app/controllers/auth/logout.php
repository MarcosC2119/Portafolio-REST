/**
 * Cierre de Sesión
 * 
 * Este archivo maneja la funcionalidad de cierre de sesión del usuario.
 * Características:
 * - Destrucción de la sesión actual
 * - Redirección a la página de inicio de sesión
 * 
 * @author Marcos Castro
 * @version 1.0
 */

<?php
session_start();
session_destroy();
header("Location: login.php");
?>