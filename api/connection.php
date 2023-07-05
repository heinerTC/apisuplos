<?php
require_once 'config.php';
class Connection
{
    public static function Connect()
    {
        $config = Config::getDatabaseConfig();

        $servername = $config['servername'];
        $port = $config['port'];
        $dbname = $config['dbname'];
        $username = $config['username'];
        $password = $config['password'];

        try {
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password, $options);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (Exception $e) {
            die("El error de Conexión es: " . $e->getMessage());
        }
    }
}
?>
