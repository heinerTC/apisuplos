<?php
require_once '../connection.php';

function verificarEstadosOfertas() {
    $conn = Connection::Connect();

    while (true) {
        $fecha_actual = date('Y-m-d');
        $hora_actual = date('H:i:s');

        // Obtener las ofertas pendientes de verificar
        $stmt = $conn->prepare('SELECT id_oferta, fecha_inicio, hora_inicio, fecha_cierre, hora_cierre, estado FROM ofertas WHERE estado IN ("ACTIVO", "PUBLICADO")');
        $stmt->execute();
        $ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($ofertas as $oferta) {
            $fecha_inicio = $oferta['fecha_inicio'];
            $hora_inicio = $oferta['hora_inicio'];
            $fecha_cierre = $oferta['fecha_cierre'];
            $hora_cierre = $oferta['hora_cierre'];
            $estado = $oferta['estado'];
            $id_oferta = $oferta['id_oferta'];

            if ($fecha_actual > $fecha_inicio || ($fecha_actual == $fecha_inicio && $hora_actual >= $hora_inicio)) {
                if ($estado != 'PUBLICADO') {
                    // Actualizar el estado a PUBLICADO
                    $stmt = $conn->prepare('UPDATE ofertas SET estado = "PUBLICADO" WHERE id_oferta = :id_oferta');
                    $stmt->bindParam(':id_oferta', $id_oferta, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }

            if ($fecha_actual > $fecha_cierre || ($fecha_actual == $fecha_cierre && $hora_actual >= $hora_cierre)) {
                if ($estado != 'EVALUACIÓN') {
                    // Actualizar el estado a EVALUACIÓN
                    $stmt = $conn->prepare('UPDATE ofertas SET estado = "EVALUACIÓN" WHERE id_oferta = :id_oferta');
                    $stmt->bindParam(':id_oferta', $id_oferta, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
        }

        // Espera un tiempo antes de verificar nuevamente en N segundos
        sleep(60);
    }
}

verificarEstadosOfertas();
?>
