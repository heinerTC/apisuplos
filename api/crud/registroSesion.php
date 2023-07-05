<?php
require_once '../connection.php';
require_once 'registro.php';

// Permitir solicitudes desde el FrontEnd del proyecto
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$conn = Connection::Connect();

// Ruta para el registro de usuarios
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['pass'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $registro = new Registro();
    $registro->registerUser($nombre, $email, $pass);
    echo "Datos recibidos en PHP";
} else {
    // Obtener los datos enviados en la solicitud POST
    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    if (isset($data['nombre']) && isset($data['email']) && isset($data['pass'])) {
        $nombre = $data['nombre'];
        $email = $data['email'];
        $pass = $data['pass'];

        $registro = new Registro();
        $registro->registerUser($nombre, $email, $pass);
        echo "Datos recibidos en PHP";
    } else {
        echo "No llegaron datos";
        var_dump($data); // Muestra los datos recibidos en la solicitud POST en formato JSON
    }
}
?>