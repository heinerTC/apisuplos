<?php
require_once '../connection.php';

class Clasificador {
    private $conn;

    public function __construct() {
        $this->conn = Connection::Connect();
    }

    public function obtenerClasificadores($nombreProducto, $nombreClase, $nombreFamilia, $nombreSegmento, $offset, $limit) {
        // Construi la consulta SQL con los parámetros seleccionados
        $sql = 'SELECT idclasificador, codigo_segmento, nombre_segmento, codigo_familia, nombre_familia, codigo_clase, nombre_clase, codigo_producto, nombre_producto FROM clasificador WHERE 1 = 1';

        if ($nombreSegmento) {
            $sql .= ' AND nombre_segmento = :nombreSegmento';
        }

        if ($nombreFamilia) {
            $sql .= ' AND nombre_familia = :nombreFamilia';
        }

        if ($nombreClase) {
            $sql .= ' AND nombre_clase = :nombreClase';
        }

        if ($nombreProducto) {
            $sql .= ' AND nombre_producto LIKE :nombreProducto';
        }

        // Limitar los resultados a un máximo de 50 registros
        $sql .= " LIMIT $offset, $limit";

        // echo($sql);

        // Preparar la consulta SQL
        $stmt = $this->conn->prepare($sql);

        if ($nombreSegmento) {
            $stmt->bindValue(':nombreSegmento', $nombreSegmento);
        }

        if ($nombreFamilia) {
            $stmt->bindValue(':nombreFamilia', $nombreFamilia);
        }

        if ($nombreClase) {
            $stmt->bindValue(':nombreClase', $nombreClase);
        }

        if ($nombreProducto) {
            $stmt->bindValue(':nombreProducto', '%' . $nombreProducto . '%');
        }

        // Ejecutar la consulta
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Respuesta JSON con los datos obtenidos
        echo json_encode($result);
        exit;
    }
}
?>
