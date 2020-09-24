<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';

#update values
$id_char 	= $_POST['id_char'];
$id_update 	= $_POST['idUpdate'];
$new_value 	= $_POST['newValue'];

$db_con = conectar();
$stmt = $db_con->prepare("UPDATE sheet_vampire_chars_virtues SET actual_value= :new_value WHERE id_vi = :id_update and id_char = :id_char");
$stmt->bindParam(":new_value", $new_value);
$stmt->bindParam(":id_update", $id_update);
$stmt->bindParam(":id_char", $id_char);

$type ="";
try {
   	if($stmt->execute()) 
	{
		echo "updateok";
	}else{
		echo "updateno";
	}
} catch (PDOException $e) {
    echo $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}
$stmt = NULL;