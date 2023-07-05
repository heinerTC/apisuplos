<?php
require_once '../connection.php';
require_once 'ofertas.php';

// Permitir solicitudes desde el FrontEnd del proyecto
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$conn = Connection::Connect();

    // Ruta para la creación de ofertas
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      echo json_encode(['success' => false, 'message' => 'Método no permitido']);
      exit;
    }

    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    $ofertas = new Ofertas();
    $ofertas->createOferta($data);

?>