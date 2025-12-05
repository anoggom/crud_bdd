<?php 

//Cambiar estos datos por los de la base.
define('DB_HOST', '*******');
define('DB_PORT', '*******');
define('DB_NAME', '*******'); 
define('DB_USER', '*******');
define('DB_PASSWORD', '*******'); 


function getDbConnection(){
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
        return $pdo;
    } catch (\PDOException $e) {
        error_log("Error de conexión a la base de datos: " . $e->getMessage());
        throw new Exception("Error en la configuración de la Base de Datos.");
    }
}
?>