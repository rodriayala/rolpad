<?php
////////////////////////////
function conectar()//
////////////////////////////
{
    try
    {
        $db_host = "localhost";
        $db_name = "rolpad";
        $db_user = "root";
        $db_pass = "";

       /*$db_host = "192.168.0.210";
        $db_name = "didonatodistribucion";
        $db_user = "didonatodistribucion";
        $db_pass = "D1D0N4.8697?";*/

        $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //echo "Connected successfully";
        return $db_con;
    }catch(PDOException $e){
        echo "Error al conectarse a la base de datos: ".$e->getMessage();
    }
}
?>