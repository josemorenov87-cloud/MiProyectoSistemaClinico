<?php

define ('SERVIDOR', 'localhost');
define ('USUARIO', 'root');
define ('PASSWORD', '');
define ('BD', 'dbinventario');

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try{
    $pdo = new PDO($servidor,USUARIO,PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    echo "La conexión ha sido exitosa";

} catch(PDOException $e){
    //print_r($e)
    echo "Error al acceder a la base de datos";
}