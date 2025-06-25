<?php
// Ensure config.php is included at the very beginning to define BASE_URL and $conn
include_once __DIR__ . '/../../config.php'; // Corrected path to app/config.php
session_start(); // Start session immediately after config

// If already authenticated, redirect to dashboard
if (isset($_SESSION['user'])) {
    // Corrected redirection path: point to the actual dashboard view
    header('Location: ' . BASE_URL . 'app/views/dashboard.php');
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
        // Corrected redirection path: point to the actual dashboard view
        header('Location: ' . BASE_URL . 'app/views/dashboard.php');
        exit();
    } else {
        $error = "Credenciales incorrectas.";
    }
}
// Define a variable to indicate the context for the header
$is_auth_page = true;
// Incluir header
include __DIR__ . '/../../views/includes/header.php';
?>
<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-black">
    <div class="max-w-md w-full space-y-8 p-8 bg-gray-900 rounded-lg shadow-xl">
        <div class="text-center">
            <h2 class="mt-6 text-4xl font-extrabold text-white">Bienvenido</h2>
            <p class="mt-2 text-yellow-500 text-xl font-semibold">Panel de Proyectos</p>
        </div>
        <form class="mt-8 space-y-6" method="post">
            <?php if($error): ?>
                <div class="bg-red-600 text-white p-3 rounded-md text-sm text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="username" class="block text-gray-300 mb-2 text-lg">Usuario</label>
                    <input id="username" name="username" type="text" required
                        class="appearance-none relative block w-full px-4 py-3 border border-gray-700 placeholder-gray-500 text-white rounded-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 bg-gray-800 text-lg"
                        placeholder="admin">
                </div>
                <div>
                    <label for="password" class="block text-gray-300 mb-2 text-lg">Contraseña</label>
                    <input id="password" name="password" type="password" required
                        class="appearance-none relative block w-full px-4 py-3 border border-gray-700 placeholder-gray-500 text-white rounded-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 bg-gray-800 text-lg"
                        placeholder="admin123">
                </div>
            </div>
            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-medium rounded-md text-black bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-300 ease-in-out">
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