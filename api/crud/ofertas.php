<?php
require_once '../connection.php';

class Ofertas {
    private $conn;

    public function __construct() {
        $this->conn = Connection::Connect();
    }

    public function createOferta($data) {
        // Validando campos requeridos
        $requiredFields = ['objeto', 'descripcion', 'moneda', 'presupuesto', 'idclasificador', 'fecha_inicio', 'hora_inicio', 'fecha_cierre', 'hora_cierre', 'idcreador'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                $response = [
                    'error' => true,
                    'message' => 'Falta completar uno o más campos requeridos.',
                ];

                echo json_encode($response);
                exit;
            }
        }

        $objeto = filter_var($data['objeto'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
        $moneda = filter_var($data['moneda'], FILTER_SANITIZE_STRING);
        $presupuesto = filter_var($data['presupuesto'], FILTER_SANITIZE_NUMBER_FLOAT);
        $idclasificador = filter_var($data['idclasificador'], FILTER_SANITIZE_NUMBER_INT);
        $fecha_inicio = filter_var($data['fecha_inicio'], FILTER_SANITIZE_STRING);
        $hora_inicio = filter_var($data['hora_inicio'], FILTER_SANITIZE_STRING);
        $fecha_cierre = filter_var($data['fecha_cierre'], FILTER_SANITIZE_STRING);
        $hora_cierre = filter_var($data['hora_cierre'], FILTER_SANITIZE_STRING);
        $estado = 'ACTIVO';
        $idcreador = filter_var($data['idcreador'], FILTER_SANITIZE_NUMBER_INT);

        $fecha_actual = date('Y-m-d');
        $hora_actual = date('H:i:s');

        if ($fecha_actual > $fecha_inicio || ($fecha_actual == $fecha_inicio && $hora_actual >= $hora_inicio)) {
            $estado = 'PUBLICADO';
        }

        if ($fecha_actual > $fecha_cierre || ($fecha_actual == $fecha_cierre && $hora_actual >= $hora_cierre)) {
            $estado = 'EVALUACIÓN';
        }

        $stmt = $this->conn->prepare('INSERT INTO ofertas (objeto, descripcion, moneda, presupuesto, idclasificador, fecha_inicio, hora_inicio, fecha_cierre, hora_cierre, estado, idcreador) VALUES (:objeto, :descripcion, :moneda, :presupuesto, :idclasificador, :fecha_inicio, :hora_inicio, :fecha_cierre, :hora_cierre, :estado, :idcreador)');

        $stmt->bindParam(':objeto', $objeto, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':moneda', $moneda, PDO::PARAM_STR);
        $stmt->bindParam(':presupuesto', $presupuesto, PDO::PARAM_STR);
        $stmt->bindParam(':idclasificador', $idclasificador, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':hora_inicio', $hora_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_cierre', $fecha_cierre, PDO::PARAM_STR);
        $stmt->bindParam(':hora_cierre', $hora_cierre, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindParam(':idcreador', $idcreador, PDO::PARAM_INT);
        $stmt->execute();

        $response = [
            'success' => true,
            'message' => 'Oferta creada exitosamente',
        ];

        echo json_encode($response);
        exit;
    }
}
?>
