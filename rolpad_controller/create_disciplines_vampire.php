<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';
include 'inc/global_functions.php';
#create values
$id_char 	= $_POST['id_char'];
$id_create 	= $_POST['idCreate'];
$name 		= $_POST['name'];

$actual_value = 0;

$db_con = conectar();
$stmt = $db_con->prepare("INSERT INTO `sheet_vampire_chars_disciplines`( `id_char`, `id_di`, `actual_value`) VALUES (:id_char,:id_create,:actual_value)");

$stmt->bindParam(":id_char", $id_char);
$stmt->bindParam(":id_create", $id_create);
$stmt->bindParam(":actual_value", $actual_value);

$type ="";
try {
   	if($stmt->execute()) 
	{		
		if($stmt->rowCount()>0)
		{
			audit($id_char,'0','0','sheet_vampire_chars_disciplines',$id_create,$name,'create');
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
$db_con=NULL;