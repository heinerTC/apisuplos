<?php
include '../../connection.php';

// Permitir solicitudes desde el FrontEnd del proyecto
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

$conn = Connection::Connect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT idofertas AS id FROM ofertas";
    $stmt = $conn->query($query);

    if ($stmt) {
        $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo json_encode($ids);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(['message' => 'Método no permitido']);
}
?>
