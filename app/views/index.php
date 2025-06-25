<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include_once __DIR__ . '/../config.php'; // Incluir config.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio - Inicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-black min-h-screen text-white">
    <?php include 'includes/header.php'; ?>

    <section id="inicio" class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto px-8 py-24">
        <div class="md:w-1/2 space-y-6">
            <p class="text-lg text-gray-300">Hola, soy <span class="font-bold">Tu Nombre</span>.</p>
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">Diseñador. Desarrollador. Creador.</h1>
            <p class="text-gray-400 text-lg">Apasionado por crear productos digitales que impactan positivamente.</p>
            <p class="text-gray-400 text-lg">Aquí puedes ver mis proyectos y experiencia.</p>
            <a href="#work" class="inline-block mt-4 text-yellow-500 hover:text-yellow-400 font-medium text-lg transition">Ver proyectos &rarr;</a>
        </div>
        </section>

    <section id="about" class="py-20 px-4 bg-gray-900">
        <div class="max-w-4xl mx-auto text-gray-200">
            <h2 class="text-4xl font-bold text-white mb-8 text-center">Sobre Mí</h2>
            <div class="md:flex md:items-center md:space-x-8">
                <div class="md:w-1/3 mb-8 md:mb-0">
                    <img src="<?= BASE_URL ?>app/uploads/profile.jpg" alt="Tu Foto de Perfil" class="rounded-full w-48 h-48 object-cover mx-auto shadow-lg">
                </div>
                <div class="md:w-2/3">
                    <p class="mb-4">
                        Como informático universitario, mi pasión radica en la exploración de nuevas tecnologías
                        y la implementación de soluciones robustas. Me especializo en el desarrollo web,
                        con un enfoque particular en la creación de interfaces de usuario intuitivas y
                        experiencias de usuario excepcionales.
                    </p>
                    <p class="mb-4">
                        Mis intereses abarcan desde la seguridad de la información y la optimización de bases de datos
                        hasta el desarrollo de aplicaciones escalables. Siempre busco la excelencia en el código y
                        la funcionalidad, comprometido con la entrega de proyectos de alta calidad.
                    </p>
                    <div class="mt-6 text-center md:text-left">
                        <a href="<?= BASE_URL ?>assets/docs/tu_cv.pdf" download class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-6 py-3 rounded-lg inline-flex items-center transition-colors duration-300">
                            <i class="fas fa-download mr-2"></i> Descargar CV
                        </a>
                    </div>
                </div>
            </div>

            <div id="skills" class="mt-16">
                <h3 class="text-3xl font-semibold text-yellow-500 mb-6 text-center">Habilidades Técnicas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-xl font-semibold text-white mb-3">Lenguajes de Programación</h4>
                        <ul class="list-disc list-inside space-y-2">
                            <li>Python <span class="text-sm text-gray-400">(Intermedio-Avanzado)</span></li>
                            <li>Java <span class="text-sm text-gray-400">(Intermedio)</span></li>
                            <li>C# <span class="text-sm text-gray-400">(Básico-Intermedio)</span></li>
                            <li>PHP <span class="text-sm text-gray-400">(Avanzado)</span></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-white mb-3">Tecnologías Web</h4>
                        <ul class="list-disc list-inside space-y-2">
                            <li>HTML5 <span class="text-sm text-gray-400">(Avanzado)</span></li>
                            <li>CSS3 (Tailwind CSS, SASS) <span class="text-sm text-gray-400">(Avanzado)</span></li>
                            <li>JavaScript (ES6+, React, Node.js) <span class="text-sm text-gray-400">(Intermedio-Avanzado)</span></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-white mb-3">Bases de Datos</h4>
                        <ul class="list-disc list-inside space-y-2">
                            <li>SQL Server <span class="text-sm text-gray-400">(Intermedio)</span></li>
                            <li>MySQL <span class="text-sm text-gray-400">(Avanzado)</span></li>
                            <li>MongoDB <span class="text-sm text-gray-400">(Básico)</span></li>
                            <li>Redis <span class="text-sm text-gray-400">(Básico)</span></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-white mb-3">Herramientas y Frameworks</h4>
                        <ul class="list-disc list-inside space-y-2">
                            <li>Git / GitHub <span class="text-sm text-gray-400">(Avanzado)</span></li>
                            <li>.NET Framework <span class="text-sm text-gray-400">(Básico)</span></li>
                            <li>Laravel <span class="text-sm text-gray-400">(Intermedio)</span></li>
                            <li>WordPress <span class="text-sm text-gray-400">(Intermedio)</span></li>
                        </ul>
                    </div>
                </div>

                <h3 class="text-3xl font-semibold text-yellow-500 mb-6 text-center mt-12">Habilidades Blandas</h3>
                <ul class="list-disc list-inside space-y-3 text-lg">
                    <li>**Trabajo en Equipo:** Excelente capacidad para colaborar en entornos multidisciplinarios, fomentando un ambiente productivo.</li>
                    <li>**Comunicación Efectiva:** Habilidad para expresar ideas técnicas y no técnicas de manera clara y concisa, tanto oralmente como por escrito.</li>
                    <li>**Adaptabilidad:** Alta disposición para aprender nuevas tecnologías y metodologías, ajustándome rápidamente a los cambios.</li>
                    <li>**Resolución de Problemas:** Gran habilidad para analizar desafíos complejos, identificar la raíz de los problemas y proponer soluciones creativas y eficientes.</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="work" class="max-w-5xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-white mb-8">Proyectos</h2>
        <div id="listaProyectos" class="space-y-6"></div>
    </section>

    <section id="contact" class="py-20 px-4 bg-gray-900">
        <div class="max-w-4xl mx-auto text-gray-200">
            <h2 class="text-4xl font-bold text-white mb-10 text-center">Contáctame</h2>
            
            <div class="flex flex-col md:flex-row justify-center items-center md:space-x-12 mb-12">
                <div class="text-center mb-8 md:mb-0">
                    <i class="fas fa-envelope text-yellow-500 text-5xl mb-3"></i>
                    <p class="text-xl font-semibold text-white">Email</p>
                    <a href="mailto:tu.correo@example.com" class="text-gray-300 hover:text-yellow-500">tu.correo@example.com</a>
                </div>
                <div class="text-center mb-8 md:mb-0">
                    <i class="fab fa-whatsapp text-yellow-500 text-5xl mb-3"></i>
                    <p class="text-xl font-semibold text-white">WhatsApp</p>
                    <a href="https://wa.me/XXXXXXXXX" target="_blank" class="text-gray-300 hover:text-yellow-500">+56 9 XXXXXXXX</a>
                </div>
                <div class="text-center">
                    <i class="fab fa-github text-yellow-500 text-5xl mb-3"></i>
                    <p class="text-xl font-semibold text-white">GitHub</p>
                    <a href="https://github.com/tu_usuario_github" target="_blank" class="text-gray-300 hover:text-yellow-500">tu_usuario_github</a>
                </div>
            </div>
        </div>
    </section>

    <script>
    // Se define BASE_URL para que sea accesible en el archivo JS externo
    const BASE_URL = '<?= BASE_URL ?>';
    </script>
    <script src="<?= BASE_URL ?>assets/js/index.js"></script>

    <?php include 'includes/footer.php'; ?>
</body>
</html>