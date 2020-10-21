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
$stmt = $db_con->prepare("UPDATE sheet_vampire_chars_chars_others SET actual_value= :new_value WHERE id_co = :id_update and id_char= :id_char");
$stmt->bindParam(":id_char", $id_char);
$stmt->bindParam(":new_value", $new_value);
$stmt->bindParam(":id_update", $id_update);

$type ="";
try {
   	if($stmt->execute()) 
	{
		audit($id_char,$new_value,'0','sheet_vampire_chars_chars_others',$id_update,$htmlTag,'update');
		echo "chars others successfully";
	}else{
		echo "chars others Error";
	}
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}