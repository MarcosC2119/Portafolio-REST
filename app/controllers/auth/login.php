
<?php
session_start();
// Ensure config.php is included at the very beginning to define BASE_URL and $conn
include_once __DIR__ . '/../../config.php'; // Corrected path to app/config.php

// Si ya está autenticado, redirigir al dashboard
if (isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'dashboard');
    exit();
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']); // MD5 for consistency with your current setup. Consider password_hash() for production.

    // Using the $conn from app/config.php
    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        // Handle error if prepare fails
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['user'] = $username;
        header('Location: ' . BASE_URL . 'dashboard');
        exit();
    } else {
        $error = "Credenciales incorrectas.";
    }
}
// Incluir header
include __DIR__ . '/../../views/includes/header.php';
?>
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-white">Bienvenido</h2>
            <p class="mt-2 text-yellow-500 text-lg font-semibold">Panel de Proyectos</p>
        </div>
        <form class="mt-8 space-y-6" method="post">
            <?php if($error): ?>
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
</div>
<?php
// Incluir footer
include __DIR__ . '/../../views/includes/footer.php';
?>