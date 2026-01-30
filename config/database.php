<?php
/**
 * Configuración de Base de Datos
 * Centro Clínico v2
 */

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'centro_clinico_v2');
define('DB_PORT', 3307);

/**
 * Conexión global (mysqli)
 */
function getConnection() {
    static $conn = null;
    
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        
        if ($conn->connect_error) {
            die('Error de conexión: ' . $conn->connect_error);
        }
        
        $conn->set_charset('utf8mb4');
    }
    
    return $conn;
}

/**
 * Alias para compatibilidad con código existente
 */
function conectar() {
    return getConnection();
}

// Conexión global para archivos que la necesiten
$conn = getConnection();

// Variable global mysqli para PSR-4 autoloader
$mysqli = getConnection();
