<?php @session_start();
class Config
{
    public static function getDatabaseConfig()
    {
        return array(
            'servername' => 'localhost',
            'port' => '3306',
            'dbname' => 'suplos',
            'username' => 'root',
            'password' => ''
        );
    }
}
?>