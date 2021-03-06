<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';
include 'inc/global_functions.php';

#update values
$id_char 	= $_POST['id_char'];
$id_update 	= $_POST['idUpdate'];
$new_value 	= $_POST['newValue'];
$htmlTag 	= $_POST['htmlTag'];

$db_con = conectar();
$stmt = $db_con->prepare("UPDATE sheet_vampire_chars_disciplines SET actual_value= :new_value WHERE id_di = :id_update and id_char = :id_char");
$stmt->bindParam(":id_char", $id_char);
$stmt->bindParam(":new_value", $new_value);
$stmt->bindParam(":id_update", $id_update);

$type ="";
try {
   	if($stmt->execute()) 
	{		
		if($stmt->rowCount()>0)
		{
			audit($id_char,$new_value,'0','sheet_vampire_chars_disciplines',$id_update,$htmlTag,'update');

			echo "chars disciplines successfully";
		}else{
			echo "chars disciplines Error";	
		}		
	}else{
		echo "chars disciplines Error";
	}	
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}

$stmt = NULL;