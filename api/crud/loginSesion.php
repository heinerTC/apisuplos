<?php
require_once '../connection.php';
require_once 'login.php';


// Permitir solicitudes desde el FrontEnd del proyecto
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');


$conn = Connection::Connect();

// Ruta para el inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['email']) && isset($data['pass'])) {
        $email = $data['email'];
        $pass = $data['pass'];

        $login = new Login();
        $result = $login->loginUser($email, $pass);

        if ($result['success']) {
            $idcreador = $result['idcreador']; 

            $response = array_merge($result, ['idcreador' => $idcreador]); // Agrego el idcreador a la respuesta
            echo json_encode($response);
        } else {
            echo json_encode(['success' => false, 'message' => 'Datos erróneos']);
        }
    }
}
?>
