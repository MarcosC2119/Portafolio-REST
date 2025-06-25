<?php
include 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : null;

// --- INICIO DE LA LÓGICA DE TUNELIZACIÓN ---
// Si la petición es POST, revisamos si se quiere simular otro método.
if ($method == 'POST' && isset($_POST['_method'])) {
    $method = strtoupper($_POST['_method']); // Puede ser 'PATCH' o 'DELETE'
}
// --- FIN DE LA LÓGICA DE TUNELIZACIÓN ---

function getInput() {
    $input = json_decode(file_get_contents("php://input"), true);
    // Si la entrada JSON está vacía (como en un POST de formulario), usamos $_POST
    if (empty($input)) {
        return $_POST;
    }
    return $input;
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204);
    exit();
}

switch ($method) {
    case 'GET':
        if ($id) {
            $stmt = $conn->prepare("SELECT * FROM proyectos WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $res = $stmt->get_result();
            echo json_encode($res->fetch_assoc());
        } else {
            $res = $conn->query("SELECT * FROM proyectos ORDER BY created_at DESC");
            $out = [];
            while ($row = $res->fetch_assoc()) {
                $out[] = $row;
            }
            echo json_encode($out);
        }
        break;

    case 'POST': // Esto es solo para crear nuevos proyectos
        $d = getInput();
        $stmt = $conn->prepare("INSERT INTO proyectos (titulo, descripcion, url_github, url_produccion, imagen) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $d['titulo'], $d['descripcion'], $d['url_github'], $d['url_produccion'], $d['imagen']);
        $stmt->execute();
        echo json_encode(["success"=>true,"id"=>$stmt->insert_id]);
        break;

    case 'PATCH': // Se activa a través del método POST + _method=PATCH
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error"=>"ID requerido para actualizar"]);
            break;
        }
        $d = getInput();
        $fields = [];
        $types = '';
        $values = [];
        // Campos permitidos para evitar inyección de campos no deseados
        $allowed_fields = ['titulo', 'descripcion', 'url_github', 'url_produccion', 'imagen'];
        foreach ($allowed_fields as $field) {
            if (isset($d[$field])) {
                $fields[] = "$field=?";
                $types .= 's';
                $values[] = $d[$field];
            }
        }
        if (empty($fields)) {
            http_response_code(400);
            echo json_encode(["error"=>"No hay campos para actualizar"]);
            break;
        }
        $types .= 'i';
        $values[] = $id;
        $sql = "UPDATE proyectos SET ".implode(",", $fields)." WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
        echo json_encode(["success"=>true]);
        break;

    case 'DELETE': // Se activa a través del método POST + _method=DELETE
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error"=>"ID requerido para eliminar"]);
            break;
        }
        $stmt = $conn->prepare("DELETE FROM proyectos WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(["success"=>true]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error"=>"Método no permitido"]);
        break;
}
?>