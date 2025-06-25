// main.js

// Se espera que BASE_URL sea una variable global
const apiUrl = `${BASE_URL}api/proyectos.php`;
const listaProyectos = document.getElementById('listaProyectos');
const proyectosDiv = document.getElementById('proyectos');

async function cargarProyectos() {
    let targetElement = listaProyectos || proyectosDiv;
    if (!targetElement) {
        console.error('No se encontró un elemento para cargar los proyectos.');
        return;
    }

    targetElement.innerHTML = '<div class="text-gray-400">Cargando proyectos...</div>';

    try {
        const res = await fetch(apiUrl);
        if (!res.ok) throw new Error(`Error HTTP! estado: ${res.status}`);
        
        const proyectos = await res.json();

        if (!proyectos.length) {
            targetElement.innerHTML = '<div class="text-gray-400">No hay proyectos públicos aún.</div>';
            return;
        }

        targetElement.innerHTML = '';
        proyectos.forEach(p => {
            const imageUrl = p.imagen ? `${BASE_URL}app/uploads/${p.imagen}` : '';
            
            // --- HTML con clases responsivas ---
            let projectHtml = `
            <div class="bg-gray-800 rounded-lg p-4 sm:p-6 flex flex-col md:flex-row items-center gap-6 shadow-lg">
                ${p.imagen ? `<img src="${imageUrl}" alt="${p.titulo}" class="w-full md:w-32 h-48 md:h-32 object-cover rounded-lg shadow-md">` : ''}
                
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-xl font-bold text-white mb-2">${p.titulo}</h3>
                    <p class="text-gray-300 mb-4">${p.descripcion}</p>
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                        ${p.url_github ? `<a href="${p.url_github}" target="_blank" class="text-yellow-500 hover:underline"><i class='fab fa-github'></i> GitHub</a>` : ''}
                        ${p.url_produccion ? `<a href="${p.url_produccion}" target="_blank" class="text-yellow-500 hover:underline"><i class='fas fa-external-link-alt'></i> Producción</a>` : ''}
                    </div>
                </div>
            `;

            // Botones de Editar/Eliminar para el dashboard
            if (targetElement === proyectosDiv) {
                projectHtml += `
                <div class="flex flex-row md:flex-col gap-2 mt-4 md:mt-0">
                    <a href="${BASE_URL}app/controllers/proyectos/edit.php?id=${p.id}" class="px-3 py-1 rounded bg-yellow-500 text-black font-semibold hover:bg-yellow-600 text-center text-sm">Editar</a>
                    <a href="${BASE_URL}app/controllers/proyectos/delete.php?id=${p.id}" onclick="return confirm('¿Seguro que deseas eliminar?')" class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 text-center text-sm">Eliminar</a>
                </div>`;
            }
             projectHtml += `</div>`;
            targetElement.innerHTML += projectHtml;
        });
    } catch (error) {
        targetElement.innerHTML = `<div class="text-red-500">Error al cargar proyectos: ${error.message}</div>`;
        console.error('Error al obtener proyectos:', error);
    }
}

document.addEventListener('DOMContentLoaded', cargarProyectos);