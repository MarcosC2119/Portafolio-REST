/**
 * Página de Inicio de Sesión
 * 
 * Este archivo maneja la autenticación y funcionalidad de inicio de sesión.
 * Proporciona una interfaz de formulario de inicio de sesión y procesa las credenciales del usuario.
 * Características:
 * - Autenticación de usuario con nombre de usuario y contraseña
 * - Gestión de sesiones
 * - Manejo de errores para credenciales inválidas
 * - Diseño responsivo usando Tailwind CSS
 * 
 * @author Marcos Castro
 * @version 1.0
 */

<?php
session_start();
include_once __DIR__ . '/../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $_SESSION['user'] = $username;
    header("Location: ../../views/dashboard.php");
    exit();
  } else {
    $error = "Credenciales incorrectas.";
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portafolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111;
        }
    </style>
</head>
<body class="min-h-screen bg-black flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-white">Bienvenido</h2>
            <p class="mt-2 text-yellow-500 text-lg font-semibold">Panel de Proyectos</p>
        </div>
        <form class="mt-8 space-y-6" method="post">
            <?php if(isset($error)): ?>
                <div class="bg-red-600 text-white p-3 rounded-md text-sm text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="username" class="block text-gray-300 mb-1">Usuario</label>
                    <input id="username" name="username" type="text" required 
                        class="w-full px-3 py-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-yellow-500 focus:ring-yellow-500" 
                        placeholder="Usuario">
                </div>
                <div>
                    <label for="password" class="block text-gray-300 mb-1">Contraseña</label>
                    <input id="password" name="password" type="password" required 
                        class="w-full px-3 py-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-yellow-500 focus:ring-yellow-500" 
                        placeholder="Contraseña">
                </div>
            </div>
            <div>
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 rounded text-black font-semibold bg-yellow-500 hover:bg-yellow-600 transition">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>
</body>
</html>
  