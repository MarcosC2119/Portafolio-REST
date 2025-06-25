// main.js

const apiUrl = `${BASE_URL}api/proyectos.php`; // BASE_URL se pasará desde PHP
const proyectosDiv = document.getElementById('proyectos');

async function cargarProyectos() {
    proyectosDiv.innerHTML = '<div class="text-gray-400">Cargando proyectos...</div>';
    try {
        const res = await fetch(apiUrl);
        if (!res.ok) {
            throw new Error(`Error HTTP! estado: ${res.status}`);
        }
        const proyectos = await res.json();
        if (proyectos.length === 0) {
            proyectosDiv.innerHTML = '<div class="text-gray-400">No hay proyectos aún.</div>';
            return;
        }
        proyectosDiv.innerHTML = '';
        proyectos.forEach(p => {
            const imageUrl = p.imagen ? `${BASE_URL}app/uploads/${p.imagen}` : '';
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
                ${p.imagen ? `<img src="${imageUrl}" alt="${p.titulo}" class="w-32 h-32 object-cover rounded-lg ml-6 mb-4 md:mb-0">` : ''}
                <div class="flex flex-col space-y-2 ml-6">
                    <a href="${BASE_URL}app/controllers/proyectos/edit.php?id=${p.id}" class="px-3 py-1 rounded bg-yellow-500 text-black font-semibold hover:bg-yellow-600 text-center">Editar</a>
                    <a href="${BASE_URL}app/controllers/proyectos/delete.php?id=${p.id}" onclick="return confirm('¿Seguro que deseas eliminar este proyecto?')" class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 text-center">Eliminar</a>
                </div>
            </div>`;
        });
    } catch (error) {
        proyectosDiv.innerHTML = `<div class="text-red-500">Error al cargar proyectos: ${error.message}</div>`;
        console.error('Error al obtener proyectos:', error);
    }
}

document.addEventListener('DOMContentLoaded', cargarProyectos);