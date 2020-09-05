<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';
#echo json_encode(array("mensaje" => "entro"));die;

#update values
$type 		= $_POST['type'];
$id_update 	= trim($_POST['idUpdate']);
$new_value 	= $_POST['newValue'];
#echo $id_char." - ".$type." - ". $id_update." - ".$newValue; 

if($type=="1"){ $table = "sheet_vampire_chars_attributes"; }
if($type=="2"){ $table = "sheet_vampire_chars_abilities"; }	

$db_con = conectar();
$stmt = $db_con->prepare("UPDATE $table SET `actual_value`=:new_value WHERE  id = :id");
$stmt->bindParam(":id", $id_update);
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
//echo json_encode($json_res);die;
//var_dump($json_res); die;