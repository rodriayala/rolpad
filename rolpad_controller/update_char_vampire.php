<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';
include 'inc/global_functions.php';
#echo json_encode(array("mensaje" => "entro"));die;

#update values
$type 		= $_POST['type'];
$id_update 	= trim($_POST['idUpdate']);
$new_value 	= $_POST['newValue'];
$id_char 	= $_POST['id_char'];
$htmlTag 	= $_POST['htmlTag'];
#echo $id_char." - ".$type." - ". $id_update." - ".$newValue; 

if($type=="1"){ $table = "sheet_vampire_chars_attributes"; }
if($type=="2"){ $table = "sheet_vampire_chars_abilities"; }	

$db_con = conectar();
$stmt = $db_con->prepare("UPDATE $table SET `actual_value`=:new_value WHERE  id = :id");
$stmt->bindParam(":id", $id_update);
$stmt->bindParam(":new_value", $new_value);

try {
   	if($stmt->execute()) 
	{
		if($stmt->rowCount()>0)
		{
			if($type=="1")
			{
				audit($id_char,$new_value,'0','sheet_vampire_chars_attributes',$id_update,$htmlTag,'update');
				echo "chars attributes successfully";
			}
			if($type=="2")
			{
				audit($id_char,$new_value,'0','sheet_vampire_chars_abilities',$id_update,$htmlTag,'update');
				echo "chars abilities successfully";
			}
		}else{
			echo "chars attributes Error";	
		}
		//echo "filas insertadas: ". $stmt->affected_rows;
		//
	}else{
		echo "chars attributes Error";	
	}
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}

$db_con = null;