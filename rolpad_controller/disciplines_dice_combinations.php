<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';
include 'inc/global_functions.php';
#create values
$disciplineid 	= $_POST['disciplineid'];
$value 			= $_POST['value'];
$name 			= $_POST['name'];

$db_con = conectar();
$stmt = $db_con->prepare("SELECT * FROM `disciplines_dice_combinations` WHERE `disciplineid` = :disciplineid and `value` = :value ");

$stmt->bindParam(":disciplineid", $disciplineid);
$stmt->bindParam(":value", $value);

$type ="";
try {
   	if($stmt->execute()) 
	{		
	   	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			$combination 	= trim($row['combination']); 
			#devolver un json con todas las ediciones y combinaciones posibles
		}		
	}else{
		echo "chars backgrounds Error";
	}	
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}
$db_con=NULL;