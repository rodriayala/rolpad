<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';
include 'inc/global_functions.php';
#update values

$id_char 	= $_POST['id_char'];
$typeInsert	= $_POST['typeInsert'];
$new_value 	= $_POST['newValue'];
$id 		= $_POST['id'];

$db_con = conectar();
$stmt = $db_con->prepare("UPDATE sheet_vampire_chars_damage SET value = :new_value WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->bindParam(":new_value", $new_value);

$type ="";
try {
   	if($stmt->execute()) 
	{		
		if($stmt->rowCount()>0)
		{
			audit($id_char,$new_value,'0','sheet_vampire_chars_damage',$id,$typeInsert,'update');
			echo "chars damage successfully";
		}else{
			echo "chars damage Error";	
		}		
	}else{
		echo "chars damage Error";
	}	
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}