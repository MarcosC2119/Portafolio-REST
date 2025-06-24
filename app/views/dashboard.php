<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php include dirname(__DIR__) . '/controllers/auth/auth.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="max-w-5xl mx-auto py-12 px-4">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-white">Panel de Proyectos</h1>
        <button id="btnNuevo" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-4 py-2 rounded transition">+ Nuevo Proyecto</button>
    </div>
    <div id="proyectos" class="space-y-4">
        <!-- Aquí se listarán los proyectos -->
    </div>
</div>

<!-- Modal Crear/Editar Proyecto -->
<div id="modalProyecto" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-900 rounded-lg p-8 w-full max-w-lg relative">
        <button id="cerrarModal" class="absolute top-2 right-2 text-gray-400 hover:text-white"><i class="fas fa-times"></i></button>
        <h2 id="modalTitulo" class="text-2xl font-bold mb-4 text-white">Nuevo Proyecto</h2>
        <form id="formProyecto" class="space-y-4">
            <input type="hidden" id="proyectoId">
            <div>
                <label class="block text-gray-300 mb-1">Título</label>
                <input type="text" id="titulo" class="w-full px-3 py-2 rounded bg-gray-800 text-white" required>
            </div>
            <div>
                <label class="block text-gray-300 mb-1">Descripción</label>
                <textarea id="descripcion" class="w-full px-3 py-2 rounded bg-gray-800 text-white" required></textarea>
            </div>
            <div>
                <label class="block text-gray-300 mb-1">URL GitHub</label>
                <input type="url" id="url_github" class="w-full px-3 py-2 rounded bg-gray-800 text-white">
            </div>
            <div>
                <label class="block text-gray-300 mb-1">URL Producción</label>
                <input type="url" id="url_produccion" class="w-full px-3 py-2 rounded bg-gray-800 text-white">
            </div>
            <div>
                <label class="block text-gray-300 mb-1">Imagen (URL)</label>
                <input type="text" id="imagen" class="w-full px-3 py-2 rounded bg-gray-800 text-white">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="cancelar" class="px-4 py-2 rounded bg-gray-700 text-gray-300 hover:bg-gray-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 rounded bg-yellow-500 text-black font-semibold hover:bg-yellow-600">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
const apiUrl = '<?= BASE_URL ?>api/proyectos.php';
const proyectosDiv = document.getElementById('proyectos');
const modal = document.getElementById('modalProyecto');
const btnNuevo = document.getElementById('btnNuevo');
const cerrarModal = document.getElementById('cerrarModal');
const cancelar = document.getElementById('cancelar');
const form = document.getElementById('formProyecto');
const modalTitulo = document.getElementById('modalTitulo');

let editando = false;

function mostrarModal(edit = false, proyecto = null) {
    modal.classList.remove('hidden');
    editando = edit;
    if (edit && proyecto) {
        modalTitulo.textContent = 'Editar Proyecto';
        document.getElementById('proyectoId').value = proyecto.id;
        document.getElementById('titulo').value = proyecto.titulo;
        document.getElementById('descripcion').value = proyecto.descripcion;
        document.getElementById('url_github').value = proyecto.url_github;
        document.getElementById('url_produccion').value = proyecto.url_produccion;
        document.getElementById('imagen').value = proyecto.imagen;
    } else {
        modalTitulo.textContent = 'Nuevo Proyecto';
        form.reset();
        document.getElementById('proyectoId').value = '';
    }
}

function ocultarModal() {
    modal.classList.add('hidden');
}

btnNuevo.onclick = () => mostrarModal(false);
cerrarModal.onclick = ocultarModal;
cancelar.onclick = ocultarModal;

form.onsubmit = async (e) => {
    e.preventDefault();
    const id = document.getElementById('proyectoId').value;
    const data = {
        titulo: document.getElementById('titulo').value,
        descripcion: document.getElementById('descripcion').value,
        url_github: document.getElementById('url_github').value,
        url_produccion: document.getElementById('url_produccion').value,
        imagen: document.getElementById('imagen').value
    };
    let res;
    if (editando && id) {
        res = await fetch(`${apiUrl}/${id}`, {
            method: 'PATCH',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        });
    } else {
        res = await fetch(apiUrl, {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        });
    }
    if (res.ok) {
        ocultarModal();
        cargarProyectos();
    }
};

async function cargarProyectos() {
    proyectosDiv.innerHTML = '<div class="text-gray-400">Cargando proyectos...</div>';
    const res = await fetch(apiUrl);
    const proyectos = await res.json();
    if (proyectos.length === 0) {
        proyectosDiv.innerHTML = '<div class="text-gray-400">No hay proyectos aún.</div>';
        return;
    }
    proyectosDiv.innerHTML = '';
    proyectos.forEach(p => {
        proyectosDiv.innerHTML += `
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
            <div class="flex flex-col space-y-2 ml-6">
                <button onclick='editarProyecto(${JSON.stringify(p)})' class="px-3 py-1 rounded bg-yellow-500 text-black font-semibold hover:bg-yellow-600">Editar</button>
                <button onclick='eliminarProyecto(${p.id})' class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700">Eliminar</button>
            </div>
        </div>`;
    });
}

window.editarProyecto = (proyecto) => {
    mostrarModal(true, proyecto);
};

window.eliminarProyecto = async (id) => {
    if (confirm('¿Seguro que deseas eliminar este proyecto?')) {
        const res = await fetch(`${apiUrl}/${id}`, { method: 'DELETE' });
        if (res.ok) cargarProyectos();
    }
};

document.addEventListener('DOMContentLoaded', cargarProyectos);
</script>

<?php include 'includes/footer.php'; ?>
