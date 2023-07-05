<?php
require_once '../connection.php';

class Documentacion
{   private $conn;

    public function __construct() {
        $this->conn = Connection::Connect();
    }
   

    public function insertarDocumento($titulo, $descripcion, $archivoRuta, $idOferta)
    {
        $query = "INSERT INTO documentacion (nombre_archivo, descripcion_archivo, ruta_archivo, idofertas) VALUES ('$titulo', '$descripcion', '$archivoRuta', '$idOferta')";

        $result = $this->conn->query($query);

        return $result;
    }

    // Otros métodos necesarios...

    public function getLastError()
    {
        return $this->conn->error;
    }
}



?>