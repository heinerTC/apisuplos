<?php
require_once '../connection.php';

class ConsultaForm
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function buscarFormularios($id, $objetoDescripcion, $comprador, $estado)
    {
        $query = "SELECT o.idofertas, o.objeto, o.descripcion, o.fecha_inicio, o.fecha_cierre, o.estado, c.nombre AS responsable,
                  o.moneda, o.presupuesto, o.hora_inicio, 
                  cl.codigo_segmento AS codigo_segmento_actividad,
                  cl.nombre_segmento AS nombre_segmento_actividad,
                  cl.codigo_familia AS codigo_familia_actividad,
                  cl.nombre_familia AS nombre_familia_actividad,
                  cl.codigo_clase AS codigo_clase_actividad,
                  cl.nombre_clase AS nombre_clase_actividad,
                  cl.codigo_producto AS codigo_producto_actividad,
                  cl.nombre_producto AS nombre_producto_actividad
                  FROM ofertas o
                  LEFT JOIN creador c ON o.idcreador = c.idcreador
                  LEFT JOIN clasificador cl ON o.idclasificador = cl.idclasificador
                  WHERE o.idofertas LIKE '%$id%'";

        if (!empty($objetoDescripcion)) {
            $query .= " AND o.objeto LIKE '%$objetoDescripcion%'";
        }

        if (!empty($comprador)) {
            $query .= " AND c.nombre LIKE '%$comprador%'";
        }

        if ($estado != 'todos') {
            $query .= " AND o.estado = '$estado'";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if ($stmt) {
            $formularios = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $formularios[] = $row;
            }

            return $formularios;
        } else {
            return false;
        }
    }
}
?>
