<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';
include 'inc/global_functions.php';
#update values
$id_char 	= $_POST['id_char'];
$htmlTag 	= strtolower(trim(substr($_POST['htmlTag'], 6)));
$new_value 	= $_POST['newValue'];


$db_con = conectar();
$stmt = $db_con->prepare("UPDATE sheet_vampire_chars SET $htmlTag= :new_value WHERE id_char = :id_char");
$stmt->bindParam(":id_char", $id_char);
$stmt->bindParam(":new_value", $new_value);

$type ="";
try {

   	if($stmt->execute()) 
	{		
		if($stmt->rowCount()>0)
		{
			audit($id_char,$new_value,'0','sheet_vampire_chars','',$htmlTag);
			echo "chars $htmlTag successfully";
		}else{
			echo "chars $htmlTag Error";	
		}		
	}else{
		echo "chars $htmlTag Error";
	}

} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}