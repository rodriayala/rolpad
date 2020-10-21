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
$stmt = $db_con->prepare("INSERT INTO `sheet_vampire_chars_backgrounds`( `id_char`, `id_bac`, `actual_value`) VALUES (:id_char,:id_create,:actual_value)");

$stmt->bindParam(":id_char", $id_char);
$stmt->bindParam(":id_create", $id_create);
$stmt->bindParam(":actual_value", $actual_value);

$type ="";
try {
   	if($stmt->execute()) 
	{		
		if($stmt->rowCount()>0)
		{
			$stmt 	= $db_con->query("SELECT LAST_INSERT_ID()");
        	$new_value = $stmt->fetchColumn(); 

			audit($id_char,'0','0','sheet_vampire_chars_backgrounds',$id_create,$name,'create');
			echo "chars backgrounds successfully";
		}else{
			echo "chars backgrounds Error";	
		}		
	}else{
		echo "chars backgrounds Error";
	}	
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}
$db_con=NULL;