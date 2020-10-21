<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';
include 'inc/global_functions.php';
#create values
$disciplineid 	= $_POST['disciplineid'];
$value 			= $_POST['value'];
$name 			= $_POST['name'];

$db_con = conectar();
$stmt = $db_con->prepare("SELECT * FROM `disciplines_dice_combinations` WHERE `value` = :value and `disciplineid` = :disciplineid ");
$stmt->bindParam(":value", $value);
$stmt->bindParam(":disciplineid", $disciplineid);

$type = "";
//$json_res =['dice_combinations' => array()];
$json_res =[];

try {
   	if($stmt->execute()) 
	{		
	   	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			$name 			= trim($row['name']); 
			$combination 	= trim($row['combination']); 
			$is_masquerade 	= trim($row['is_masquerade']); 
			$edition 		= trim($row['edition']); 
			#devolver un json con todas las ediciones y combinaciones posibles
			$json_res_init = array('dice_combinations' => array("name" => "$name",
									"combination" => "$combination",
									"is_masquerade" => "$is_masquerade",	
									"edition" => "$edition"));

			$json_res[] = $json_res_init;
			

		}		
	}else{
		$type = "error";
	}	
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}
$db_con=NULL;

if($type == "error")
{
	http_response_code(403);
	echo json_encode(array("mensaje" => "Error al consultar intente nuevamente."));	
}else{
	http_response_code(200);
	echo json_encode($json_res);
}