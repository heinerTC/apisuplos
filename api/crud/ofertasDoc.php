<?php
require_once '../connection.php';

class OfertasDoc
{
    private $conn;
    private $userId;

    public function __construct($conn, $userId)
    {
        $this->conn = $conn;
        $this->userId = $userId;
    }

    public function obtenerOfertas()
    {
        $query = "SELECT o.idofertas, o.objeto, o.descripcion, d.nombre_archivo, d.descripcion_archivo, d.ruta_archivo
                  FROM ofertas o
                  LEFT JOIN documentacion d ON o.idofertas = d.idofertas
                  WHERE o.idcreador = :userId";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':userId', $this->userId);
        $stmt->execute();

        if ($stmt) {
            $ofertas = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ofertaId = $row['idofertas'];

                // Verificar si la oferta ya existe en el array
                if (!isset($ofertas[$ofertaId])) {
                    $ofertas[$ofertaId] = array(
                        'id' => $ofertaId,
                        'nombre' => $row['objeto'],
                        'descripcion' => $row['descripcion'],
                        'archivos' => array()
                    );
                }

                // Agregar el archivo adjunto a la oferta
                if ($row['nombre_archivo']) {
                    $archivo = array(
                        'nombre_archivo' => $row['nombre_archivo'],
                        'descripcion_archivo' => $row['descripcion_archivo'],
                        'ruta_archivo' => $row['ruta_archivo']
                    );
                    $ofertas[$ofertaId]['archivos'][] = $archivo;
                }
            }

            return array_values($ofertas); // Convertir el array asociativo en un array indexado
        } else {
            return false;
        }
    }
}
?>
