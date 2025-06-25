# Portafolio Personal - Sistema de Gestión de Proyectos

Este es un sistema web para gestionar y mostrar un portafolio personal de proyectos. Permite a los administradores agregar, editar y eliminar proyectos, incluyendo detalles como título, descripción, enlaces a GitHub y producción, e imágenes.

DEMO: https://teclab.uct.cl/~marcos.castro/DB/login.php

## 🚀 Características

- Sistema de autenticación de usuarios
- Gestión completa de proyectos (CRUD)
- Almacenamiento de imágenes de proyectos
- Interfaz responsive con Tailwind CSS
- Panel de administración seguro
- Base de datos MySQL para almacenamiento persistente
- API REST para gestión de proyectos

## 📋 Requisitos Previos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- XAMPP (recomendado para desarrollo local)

## 🛠️ Instalación Rápida

### Opción 1: Instalación Automática (Recomendada)

1. Clona este repositorio en tu servidor web:
   ```bash
   git clone [URL_DEL_REPOSITORIO]
   cd Portafolio-REST
   ```

2. **Ejecuta el script de instalación automática:**
   - Abre tu navegador y ve a: `http://localhost/Portafolio-REST/install.php`
   - El script configurará automáticamente la base de datos y verificará todos los requisitos

3. **¡Listo!** El portafolio estará funcionando en:
   - Página principal: `http://localhost/Portafolio-REST/`
   - Panel de administración: `http://localhost/Portafolio-REST/app/controllers/auth/login.php`
   - Usuario: `admin`
   - Contraseña: `admin123`

### Opción 2: Instalación Manual

1. Clona este repositorio en tu servidor web

2. Importa la base de datos:
   - Accede a phpMyAdmin (http://localhost/phpmyadmin)
   - Crea una nueva base de datos llamada `portafolio_db`
   - Importa el archivo `sql/portafolio.sql`

3. Verifica la configuración de base de datos:
   - Abre `db.php` y `api/config.php`
   - Verifica que los datos de conexión coincidan con tu configuración:
     ```php
     $host = "localhost";
     $db = "portafolio_db";
     $user = "root";
     $pass = "";
     ```

4. Accede al sistema:
   - URL: http://localhost/Portafolio-REST/
   - Usuario por defecto: `admin`
   - Contraseña por defecto: `admin123`

## 📁 Estructura del Proyecto

```
Portafolio-REST/
├── api/                    # API REST
│   ├── config.php         # Configuración de la API
│   └── proyectos.php      # Endpoints de proyectos
├── app/                   # Aplicación principal
│   ├── config.php         # Configuración general
│   ├── controllers/       # Controladores
│   │   ├── auth/         # Autenticación
│   │   └── proyectos/    # Gestión de proyectos
│   ├── uploads/          # Directorio para imágenes
│   └── views/            # Vistas
│       ├── includes/     # Componentes reutilizables
│       ├── dashboard.php # Panel de administración
│       └── index.php     # Página principal
├── assets/               # Archivos estáticos
├── sql/                  # Scripts de base de datos
│   └── portafolio.sql    # Esquema y datos iniciales
├── db.php                # Configuración de base de datos
├── index.php             # Punto de entrada principal
├── install.php           # Script de instalación automática
└── .htaccess             # Configuración del servidor web
```

## 🔧 Solución de Problemas

### Error de conexión a la base de datos
- Verifica que XAMPP esté ejecutándose
- Asegúrate de que MySQL esté activo
- Verifica las credenciales en `db.php` y `api/config.php`

### Error 404 en las rutas
- Verifica que el módulo `mod_rewrite` esté habilitado en Apache
- Asegúrate de que el archivo `.htaccess` esté presente

### Problemas de permisos
- Verifica que el directorio `app/uploads` tenga permisos de escritura

## 🔒 Seguridad

- Las contraseñas se almacenan usando MD5 (se recomienda actualizar a un método más seguro en producción)
- Sistema de autenticación para proteger el panel de administración
- Validación de datos en formularios
- Protección contra inyección SQL usando prepared statements

## 🎨 Tecnologías Utilizadas

- PHP (Backend)
- MySQL (Base de datos)
- HTML5
- CSS (Tailwind CSS)
- JavaScript
- XAMPP (Entorno de desarrollo)

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE.md](LICENSE.md) para más detalles.

## ✨ Créditos

Desarrollado con asistencia de:
- GitHub Copilot
