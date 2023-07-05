<?php
require_once '../connection.php';
require_once 'clasificador.php';

// Permitir solicitudes desde el FrontEnd del proyecto
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$conn = Connection::Connect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener los valores seleccionados del formulario o la solicitud GET
    $params = $_GET;

    $nombreProducto = isset($params['nombre_producto']) ? $params['nombre_producto'] : null;
    $nombreClase = isset($params['nombre_clase']) ? $params['nombre_clase'] : null;
    $nombreFamilia = isset($params['nombre_familia']) ? $params['nombre_familia'] : null;
    $nombreSegmento = isset($params['nombre_segmento']) ? $params['nombre_segmento'] : null;

    $offset = isset($params['offset']) ? intval($params['offset']) : 0;
    $limit = isset($params['limit']) ? intval($params['limit']) : 100;

    $clasificador = new Clasificador();
    $clasificador->obtenerClasificadores($nombreProducto, $nombreClase, $nombreFamilia, $nombreSegmento, $offset, $limit);
    
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

exit;
?>

