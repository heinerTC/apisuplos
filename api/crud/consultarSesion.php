<?php
require_once '../connection.php';
require_once 'consultar.php';

// Permitir solicitudes desde el FrontEnd del proyecto
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Obtener los parámetros de búsqueda
$id = $_GET['id'] ?? '';
$objetoDescripcion = $_GET['objetoDescripcion'] ?? '';
$comprador = $_GET['comprador'] ?? '';
$estado = $_GET['estado'] ?? '';

$conn = Connection::Connect();

$consultaForm = new ConsultaForm($conn);

// Realizar búsqueda de formularios
$resultados = $consultaForm->buscarFormularios($id, $objetoDescripcion, $comprador, $estado);

// resultados en formato JSON
header('Content-Type: application/json');
echo json_encode($resultados);

$conn = null;
?>
