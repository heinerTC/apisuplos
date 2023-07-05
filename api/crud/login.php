<?php
require_once '../connection.php';

class Login {
    private $conn;

    public function __construct() {
        $this->conn = Connection::Connect();
    }

    public function loginUser($email, $pass) {
        // Consulta SQL para verificar las credenciales del usuario
        $stmt = $this->conn->prepare('SELECT * FROM creador WHERE email = :email AND pass = :pass');
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':pass', $pass);
        $stmt->execute();

        // Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($stmt->rowCount() > 0) {
            // Inicio de sesión exitoso
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $userId = $user['idcreador'];
            $nombreUsuario = $user['nombre'];

            // Ejemplo de respuesta JSON para inicio de sesión exitoso
            $response = [
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'user' => [
                    'idcreador' => $userId,
                    'nombre' => $nombreUsuario,
                    // Otros campos del usuario
                ]
            ];
        } else {
            // Credenciales inválidas
            $response = [
                'success' => false,
                'message' => 'Credenciales inválidas',
            ];
        }

        echo json_encode($response);
        exit;
    }
}
?>
