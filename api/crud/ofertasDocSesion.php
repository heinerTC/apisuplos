<?php
require_once '../connection.php';
require_once 'ofertasDoc.php';

// Permitir solicitudes desde el FrontEnd del proyecto
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$conn = Connection::Connect();

// Obtener el ID del usuario logueado desde la URL
$userId = isset($_GET['userId']) ? $_GET['userId'] : null;

if ($userId !== null) {
    $ofertasDoc = new OfertasDoc($conn, $userId);

    // Obtener las ofertas utilizando los métodos de "ofertasDoc.php"
    $ofertas = $ofertasDoc->obtenerOfertas();

    // Retornar las ofertas como JSON
    echo json_encode($ofertas);
} else {
    echo 'Error: Usuario no identificado';
}
?>
