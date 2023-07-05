<?php
require_once '../../connection.php';

// Permitir solicitudes desde el FrontEnd del proyecto
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

$conn = Connection::Connect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT idcreador, nombre FROM creador";
    $stmt = $conn->query($query);

    if ($stmt) {
        $compradores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($compradores);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(['message' => 'Método no permitido']);
}
?>
