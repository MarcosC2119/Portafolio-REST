<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include_once __DIR__ . '/../config.php';
if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'app/controllers/auth/login.php');
    exit();
}
$is_dashboard_page = true;
?>
<?php include 'includes/header.php'; ?>

<div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row items-center justify-between mb-8 gap-4">
        <h1 class="text-2xl sm:text-3xl font-bold text-white text-center sm:text-left">Panel de Proyectos</h1>
        <a href="<?= BASE_URL ?>app/controllers/proyectos/add.php" class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-4 py-2 rounded transition text-center">+ Nuevo Proyecto</a>
    </div>
    <div id="proyectos" class="space-y-4">
        </div>
</div>

<script>
    const BASE_URL = '<?= BASE_URL ?>';
</script>
<script src="<?= BASE_URL ?>assets/js/index.js"></script>

<?php include 'includes/footer.php'; ?>