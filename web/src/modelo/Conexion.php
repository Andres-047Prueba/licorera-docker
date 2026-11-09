<?php
// Conexión a la base de datos usando PDO.
// Los datos salen de variables de entorno (definidas en docker-compose.yml / .env).
// DB_HOST es el NOMBRE DEL SERVICIO de la base de datos en la red de Docker ("db").

class Conexion{
    private static $conexion = null;
    private function __construct(){

    }

    public static function Conectar(){
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT') ?: '3306';
        $name = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');

        if (!$host || !$name || !$user || $pass === false) {
            throw new RuntimeException('Faltan variables de entorno de la base de datos (DB_HOST, DB_NAME, DB_USER, DB_PASSWORD).');
        }

        $pdo_options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        self::$conexion = new PDO("mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4", $user, $pass, $pdo_options);
        return self::$conexion;
    }

    static function Desconectar(&$conn){
        $conn = null;
    }
}
?>
