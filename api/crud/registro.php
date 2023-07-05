<?php
require_once '../connection.php';

class Registro {
    private $conn;

    public function __construct() {
        $this->conn = Connection::Connect();
    }

    public function registerUser($nombre, $email, $pass) {
        // Consulta SQL para insertar el nuevo usuario en la base de datos
        $stmt = $this->conn->prepare('INSERT INTO creador (nombre, email, pass) VALUES (:nombre, :email, :pass)');
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':pass', $pass);
        $stmt->execute();

        // Respuesta JSON para registro exitoso
        $response = [
            'success' => true,
            'message' => 'Registro exitoso',
        ];

        echo json_encode($response);
        exit;
    }
}
?>
