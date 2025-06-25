# Uso de IA para Generación de Estilos en el Proyecto

En este proyecto se utilizó inteligencia artificial (IA) Google Gemini AI 2.5 PRO para asistir en la creación y mejora de los estilos visuales, la estructura del header y la navegación, empleando Tailwind CSS y buenas prácticas de diseño web.

## Prompts Utilizados

- "Genera un header moderno y responsivo con Tailwind CSS para un portafolio personal."
- "Haz que el menú de navegación quede fijo en la parte superior usando clases de Tailwind."
- "Actualiza el menú para que solo muestre el botón de Inicio en la página de login."
- "Sugiere una paleta de colores y tipografía adecuada para un sitio profesional de portafolio."

## Ejemplo de Respuesta de la IA

```php
<nav class="bg-black fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Menú izquierdo -->
            <div class="flex items-center space-x-8">
                <a href="<?= BASE_URL ?>" class="text-lg font-semibold text-yellow-500">Inicio</a>
                <a href="#about" class="text-lg font-medium text-gray-200 hover:text-yellow-500 transition">Sobre Mí</a>
                <!-- ...otros enlaces... -->
            </div>
        </div>
    </div>
</nav>
```

## Detalles del Proceso

La IA fue utilizada para:
- Sugerir y estructurar la navegación principal.
- Recomendar clases de Tailwind para lograr un diseño moderno y responsivo.
- Proveer ejemplos de código para menús condicionales según la página (dashboard, login, etc).
- Optimizar la experiencia visual y la accesibilidad del sitio.

Esto permitió acelerar el desarrollo y mantener buenas prácticas de diseño.
