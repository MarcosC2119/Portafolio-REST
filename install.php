<?php
/**
 * Script de Instalación del Portafolio
 * 
 * Este script configura automáticamente la base de datos y verifica
 * que todos los requisitos estén cumplidos.
 */

echo "<h1>Instalación del Portafolio</h1>";

// Verificar si PHP está funcionando
echo "<h2>1. Verificando PHP...</h2>";
echo "Versión de PHP: " . phpversion() . "<br>";
echo "✅ PHP está funcionando correctamente<br><br>";

// Verificar extensión mysqli
echo "<h2>2. Verificando extensiones...</h2>";
if (extension_loaded('mysqli')) {
    echo "✅ Extensión mysqli está disponible<br>";
} else {
    echo "❌ Extensión mysqli NO está disponible<br>";
    echo "Por favor, habilita la extensión mysqli en tu configuración de PHP<br><br>";
    exit;
}

// Intentar conectar a MySQL
echo "<h2>3. Verificando conexión a MySQL...</h2>";
$host = "localhost";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    echo "❌ No se pudo conectar a MySQL: " . $conn->connect_error . "<br>";
    echo "Asegúrate de que XAMPP esté ejecutándose y MySQL esté activo<br><br>";
    exit;
} else {
    echo "✅ Conexión a MySQL exitosa<br>";
}

// Crear base de datos
echo "<h2>4. Configurando base de datos...</h2>";
$db_name = "portafolio_db";

// Verificar si la base de datos ya existe
$result = $conn->query("SHOW DATABASES LIKE '$db_name'");
if ($result->num_rows > 0) {
    echo "✅ La base de datos '$db_name' ya existe<br>";
} else {
    // Crear la base de datos
    if ($conn->query("CREATE DATABASE $db_name")) {
        echo "✅ Base de datos '$db_name' creada exitosamente<br>";
    } else {
        echo "❌ Error al crear la base de datos: " . $conn->error . "<br>";
        exit;
    }
}

// Seleccionar la base de datos
$conn->select_db($db_name);

// Crear tablas
echo "<h2>5. Creando tablas...</h2>";

// Tabla users
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_users)) {
    echo "✅ Tabla 'users' creada/verificada<br>";
} else {
    echo "❌ Error al crear tabla 'users': " . $conn->error . "<br>";
}

// Tabla proyectos
$sql_proyectos = "CREATE TABLE IF NOT EXISTS proyectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    url_github VARCHAR(255),
    url_produccion VARCHAR(255),
    imagen VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_proyectos)) {
    echo "✅ Tabla 'proyectos' creada/verificada<br>";
} else {
    echo "❌ Error al crear tabla 'proyectos': " . $conn->error . "<br>";
}

// Insertar usuario por defecto
echo "<h2>6. Configurando usuario por defecto...</h2>";
$admin_username = "admin";
$admin_password = md5("admin123");

$check_user = $conn->query("SELECT id FROM users WHERE username = '$admin_username'");
if ($check_user->num_rows == 0) {
    $sql_insert = "INSERT INTO users (username, password) VALUES ('$admin_username', '$admin_password')";
    if ($conn->query($sql_insert)) {
        echo "✅ Usuario administrador creado<br>";
        echo "Usuario: admin<br>";
        echo "Contraseña: admin123<br>";
    } else {
        echo "❌ Error al crear usuario administrador: " . $conn->error . "<br>";
    }
} else {
    echo "✅ Usuario administrador ya existe<br>";
}

// Verificar directorios
echo "<h2>7. Verificando directorios...</h2>";
$directories = [
    'app/uploads',
    'assets'
];

foreach ($directories as $dir) {
    if (is_dir($dir)) {
        echo "✅ Directorio '$dir' existe<br>";
    } else {
        if (mkdir($dir, 0755, true)) {
            echo "✅ Directorio '$dir' creado<br>";
        } else {
            echo "❌ No se pudo crear el directorio '$dir'<br>";
        }
    }
}

echo "<h2>8. Instalación completada</h2>";
echo "✅ El portafolio está listo para usar<br>";
echo "<br>";
echo "<strong>Próximos pasos:</strong><br>";
echo "1. Accede a <a href='index.php'>la página principal</a><br>";
echo "2. Para administrar proyectos, ve a <a href='app/controllers/auth/login.php'>login</a><br>";
echo "3. Usa las credenciales: admin / admin123<br>";

$conn->close();
?> 