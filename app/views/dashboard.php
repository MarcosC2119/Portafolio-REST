<?php
if (session_status() === PHP_SESSION_NONE) session_start();
// RUTA CORREGIDA: Apunta a app/config.php desde app/views/dashboard.php
include_once __DIR__ . '/../config.php'; //
if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'app/controllers/auth/login.php');
    exit();
}
?>
<?php include 'includes/header.php'; ?>

<div class="max-w-5xl mx-auto py-12 px-4">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-white">Panel de Proyectos</h1>
        <a href="<?= BASE_URL ?>app/controllers/proyectos/add.php" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-4 py-2 rounded transition">+ Nuevo Proyecto</a>
    </div>
    <div id="proyectos" class="space-y-4">
        </div>
</div>

<script>
    // Se define BASE_URL para que sea accesible en el archivo JS externo
    const BASE_URL = '<?= BASE_URL ?>';
</script>
<script src="<?= BASE_URL ?>assets/js/main.js"></script>

<?php include 'includes/footer.php'; ?>