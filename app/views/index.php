<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio - Inicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-black min-h-screen text-white">
    <?php include 'includes/header.php'; ?>
    <!-- Hero principal -->
    <section class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto px-8 py-24">
        <div class="md:w-1/2 space-y-6">
            <p class="text-lg text-gray-300">Hola, soy <span class="font-bold">[Tu Nombre]</span>.</p>
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">Diseñador. Desarrollador. Creador.</h1>
            <p class="text-gray-400 text-lg">Apasionado por crear productos digitales que impactan positivamente.</p>
            <p class="text-gray-400 text-lg">Aquí puedes ver mis proyectos y experiencia.</p>
            <a href="#proyectos" class="inline-block mt-4 text-yellow-500 hover:text-yellow-400 font-medium text-lg transition">Ver proyectos &rarr;</a>
        </div>
        <!-- Puedes agregar aquí la imagen de perfil si lo deseas -->
    </section>

    <!-- Proyectos públicos -->
    <section id="proyectos" class="max-w-5xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-white mb-8">Proyectos</h2>
        <div id="listaProyectos" class="space-y-6"></div>
    </section>

    <script>
    const apiUrl = '<?= BASE_URL ?>api/proyectos.php';
    const listaProyectos = document.getElementById('listaProyectos');

    async function cargarProyectos() {
        listaProyectos.innerHTML = '<div class="text-gray-400">Cargando proyectos...</div>';
        const res = await fetch(apiUrl);
        const proyectos = await res.json();
        if (!proyectos.length) {
            listaProyectos.innerHTML = '<div class="text-gray-400">No hay proyectos públicos aún.</div>';
            return;
        }
        listaProyectos.innerHTML = '';
        proyectos.forEach(p => {
            listaProyectos.innerHTML += `
            <div class="bg-gray-800 rounded-lg p-6 flex flex-col md:flex-row items-center justify-between shadow">
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-white mb-1">${p.titulo}</h3>
                    <p class="text-gray-300 mb-2">${p.descripcion}</p>
                    <div class="flex flex-wrap gap-4 mb-2">
                        ${p.url_github ? `<a href="${p.url_github}" target="_blank" class="text-yellow-500 hover:underline"><i class='fab fa-github'></i> GitHub</a>` : ''}
                        ${p.url_produccion ? `<a href="${p.url_produccion}" target="_blank" class="text-yellow-500 hover:underline"><i class='fas fa-external-link-alt'></i> Producción</a>` : ''}
                    </div>
                </div>
                ${p.imagen ? `<img src="${p.imagen}" alt="${p.titulo}" class="w-32 h-32 object-cover rounded-lg ml-6 mb-4 md:mb-0">` : ''}
            </div>`;
        });
    }
    document.addEventListener('DOMContentLoaded', cargarProyectos);
    </script>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
