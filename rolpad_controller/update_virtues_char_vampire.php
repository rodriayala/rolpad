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
$stmt = $db_con->prepare("UPDATE sheet_vampire_chars_virtues SET actual_value= :new_value WHERE id_vi = :id_update and id_char = :id_char");
$stmt->bindParam(":new_value", $new_value);
$stmt->bindParam(":id_update", $id_update);
$stmt->bindParam(":id_char", $id_char);

$type ="";
try {
   	if($stmt->execute()) 
	{		
		if($stmt->rowCount()>0)
		{
			audit($id_char,$new_value,'0','sheet_vampire_chars_virtues',$id_update,$htmlTag,'update');
			echo "chars virtues successfully";
		}else{
			echo "chars virtues Error";	
		}		
	}else{
		echo "chars virtues Error";
	}
} catch (PDOException $e) {
    echo $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}
$stmt = NULL;