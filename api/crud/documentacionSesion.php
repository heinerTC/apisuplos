<?php
require_once '../connection.php';
require_once 'documentacion.php';

// Permitir solicitudes desde el FrontEnd del proyecto
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$conn = Connection::Connect();

// Ruta para agregar documentos a la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se enviaron los datos requeridos
    if (
        isset($_POST['titulo']) &&
        isset($_POST['descripcion']) &&
        isset($_POST['idoferta'])
    ) {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $idOferta = $_POST['idoferta'];

        // Crear una instancia de la clase Documentacion
        $documentacion = new Documentacion($conn);

        // Obtener los archivos enviados
        $archivos = $_FILES['archivo'];

        // Verificar si se envió un solo archivo o múltiples archivos
        if (is_array($archivos['name'])) {
            $numArchivos = count($archivos['name']);
        } else {
            $numArchivos = 1;
            $archivos = array(
                'name' => array($archivos['name']),
                'tmp_name' => array($archivos['tmp_name']),
                'type' => array($archivos['type']),
                'size' => array($archivos['size'])
            );
        }

        // Iterar sobre los archivos
        for ($i = 0; $i < $numArchivos; $i++) {
            $archivoNombre = $archivos['name'][$i];
            $archivoTmpPath = $archivos['tmp_name'][$i];
            $archivoTipo = $archivos['type'][$i];
            $archivoSize = $archivos['size'][$i];

            // Directorio donde se guardarán los archivos
            $directorio = '../documentos/';

            // Generar un nombre único para el archivo
            $archivoNombreUnico = uniqid() . '_' . $archivoNombre;

            // Ruta completa del archivo en el servidor
            $archivoRuta = $directorio . $archivoNombreUnico;

            // Validar el tipo de archivo si es necesario
            $allowedTypes = [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'text/plain'
            ];

            if (!in_array($archivoTipo, $allowedTypes)) {
                $response = array(
                    'error' => true,
                    'message' => 'El tipo de archivo seleccionado no es válido. Se permiten archivos PDF, DOC, DOCX, XLS, XLSX, PPT, y TXT.'
                );
                echo json_encode($response);
                exit();
            }

            // Mover el archivo a su ubicación final
            if (!move_uploaded_file($archivoTmpPath, $archivoRuta)) {
                $response = array(
                    'error' => true,
                    'message' => 'Error al mover el archivo.'
                );
                echo json_encode($response);
                exit();
            }

            // Insertar el documento en la base de datos
            $result = $documentacion->insertarDocumento($titulo, $descripcion, $archivoRuta, $idOferta);

            if (!$result) {
                $response = array(
                    'error' => true,
                    'message' => 'Error al agregar el documento a la base de datos: ' . $documentacion->getLastError()
                );
                echo json_encode($response);
                exit();
            }
        }

        $response = array(
            'success' => true,
            'message' => 'Documentos guardados exitosamente.'
        );
        echo json_encode($response);
        exit();
    } else {
        $response = array(
            'error' => true,
            'message' => 'Faltan datos requeridos.'
        );
        echo json_encode($response);
        exit();
    }
}
?>
