<?php
function conectaDB()
{
    //Configuracion de la conexion a base de datos
    $bd_host = "mysql";
    $bd_usuario = "usuario";
    $bd_password = "1234567";
    $bd_base = "tasks-app";
    try {
        $dsn = "mysql:host=$bd_host;dbname=$bd_base";
        $dbh = new PDO($dsn, $bd_usuario, $bd_password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
