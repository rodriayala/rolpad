<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';

#update values

$id_char 	= $_POST['id_char'];
$typeInsert	= $_POST['typeInsert'];
$new_value 	= $_POST['newValue'];

$db_con = conectar();
$stmt = $db_con->prepare("UPDATE sheet_vampire_chars_damage SET $typeInsert= :new_value WHERE id_char = :id_char");
$stmt->bindParam(":id_char", $id_char);
$stmt->bindParam(":new_value", $new_value);

$type ="";
try {
   	if($stmt->execute()) 
	{
		echo "updateok";
	}else{
		echo "updateno";
	}
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}