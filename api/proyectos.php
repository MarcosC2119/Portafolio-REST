<?php
include 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];
$pathInfo = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';
$id = ($pathInfo !== '') ? intval(explode('/', $pathInfo)[0]) : null;

function getInput() {
    return json_decode(file_get_contents("php://input"), true);
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

    case 'POST':
        $d = getInput();
        $stmt = $conn->prepare("INSERT INTO proyectos (titulo, descripcion, url_github, url_produccion, imagen) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $d['titulo'], $d['descripcion'], $d['url_github'], $d['url_produccion'], $d['imagen']);
        $stmt->execute();
        echo json_encode(["success"=>true,"id"=>$stmt->insert_id]);
        break;

    case 'PATCH':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error"=>"ID requerido"]);
            break;
        }
        $d = getInput();
        $fields = [];
        $types = '';
        $values = [];
        foreach ($d as $k => $v) {
            $fields[] = "$k=?";
            $types .= 's';
            $values[] = $v;
        }
        $types .= 'i';
        $values[] = $id;
        $sql = "UPDATE proyectos SET ".implode(",", $fields)." WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
        echo json_encode(["success"=>true]);
        break;

    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error"=>"ID requerido"]);
            break;
        }
        $stmt = $conn->prepare("DELETE FROM proyectos WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(["success"=>true]);
        break;

    case 'OPTIONS':
        // Preflight CORS
        http_response_code(204);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error"=>"Método no permitido"]);
        break;
}
?>