<?php
require_once '../../connection.php';

// Permitir solicitudes desde el FrontEnd del proyecto
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

$conn = Connection::Connect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT CONCAT(objeto, ' - ', descripcion) AS objeto_descripcion FROM ofertas";
    $stmt = $conn->query($query);

    if ($stmt) {
        $objetos_descripciones = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo json_encode($objetos_descripciones);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(['message' => 'Método no permitido']);
}
?>
