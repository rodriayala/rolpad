<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';

#create values
$id_char 	= $_POST['id_char'];
$id_create 	= $_POST['idCreate'];
$actual_value = 0;

$db_con = conectar();
$stmt = $db_con->prepare("INSERT INTO `sheet_vampire_chars_chars_others`( `id_char`, `id_co`, `actual_value`) VALUES (:id_char,:id_create,:actual_value)");

$stmt->bindParam(":id_char", $id_char);
$stmt->bindParam(":id_create", $id_create);
$stmt->bindParam(":actual_value", $actual_value);

$type ="";
try {
   	if($stmt->execute()) 
	{
		echo "createok";
	}else{
		echo "createno";
	}
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}
$db_con=NULL;