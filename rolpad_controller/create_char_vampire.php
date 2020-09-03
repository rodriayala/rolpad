<?php

include("inc/dbconfig.php");
#echo json_encode(array("mensaje" => "entro"));die;

############PRIMERO INSERTO LOS DATOS NECESARIOS PARA HACER UN UPDATE
#Set default values
$type = "";
$is_npc = 0;
$player = $_POST['player'];
$chronicle=$_POST['chronicle'];
$willpower_total =1;
$willpower_subtotal=1;
$bloodpool_total=10;
$bloodpool_used=10;
$experience=0;

////////////////////////////////////////////////////////////////////////////////////////
$db_con = conectar();
$stmt = $db_con->prepare("INSERT INTO `sheet_vampire_chars`
	(`is_npc`,`player`,`chronicle`,`willpower_total`,`willpower_subtotal`,`bloodpool_total`,`bloodpool_used`,`experience`) VALUES (:is_npc,:player,:chronicle,:willpower_total,:willpower_subtotal,:bloodpool_total,:bloodpool_used,:experience )");
$stmt->bindParam(":is_npc", $is_npc);
$stmt->bindParam(":player", $player);
$stmt->bindParam(":chronicle", $chronicle);
$stmt->bindParam(":willpower_total", $willpower_total);
$stmt->bindParam(":willpower_subtotal", $willpower_subtotal);
$stmt->bindParam(":bloodpool_total", $bloodpool_total);
$stmt->bindParam(":bloodpool_used", $bloodpool_used);
$stmt->bindParam(":experience", $experience);


try {
    if ($stmt->execute())//SI PUDO AGREGAR LA CABECERA CONTINUO GUARDANDO
    {
		$stmt 	= $db_con->query("SELECT LAST_INSERT_ID()");
        $id_char = $stmt->fetchColumn(); 
    }
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al crear el vampiro" . $e->getMessage();
    $type = "error";
}

////////////////////////////////////////////////////////////////////////////////////////	
$db_con2 = conectar();
$stmt2 = $db_con2->prepare("SELECT * FROM `sheet_vampire_opt_attributes`");

try {
	$stmt2->execute();
    while($row=$stmt2->fetch(PDO::FETCH_ASSOC))
    {
		$id_ab 		= $row['id_ab']; 
		$column_al 	= $row['column_al'];
		$actual_value = 1;

		$db_con3 = conectar();
		$stmt3 = $db_con3->prepare("INSERT INTO `sheet_vampire_chars_attributes`(`id_char`, `id_at`, `actual_value`,column_al) VALUES (:id_char,:id_ab,:actual_value,:column_al)");
		$stmt3->bindParam(":id_char", $id_char);
		$stmt3->bindParam(":id_ab", $id_ab);
		$stmt3->bindParam(":actual_value", $actual_value);
		$stmt3->bindParam(":column_al", $column_al);
		$stmt3->execute();
    }
 } catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al crear el detalle " . $e->getMessage();
    $type = "error";
}
/////////////////////////////////////////////////////////////////////////////////////////
$db_con4 = conectar();
$stmt4 = $db_con4->prepare("SELECT * FROM `sheet_vampire_opt_abilities`
WHERE true and `is_masquerade` = 1 and `is_concealable` = 0
ORDER BY `id`  ASC ");

try {
	$stmt4->execute();
    while($row4=$stmt4->fetch(PDO::FETCH_ASSOC))
    {
		$id_ab 		= $row4['id']; 
		#$column_al 	= $row4['column_al'];
		$actual_value = 0;

		$db_con5 = conectar();
		$stmt5 = $db_con5->prepare("INSERT INTO `sheet_vampire_chars_abilities`( `id_char`, `id_ab`, `actual_value`) VALUES (:id_char,:id_ab,:actual_value)");
		$stmt5->bindParam(":id_char", $id_char);
		$stmt5->bindParam(":id_ab", $id_ab);
		$stmt5->bindParam(":actual_value", $actual_value);
		$stmt5->execute();
    }
 } catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al crear la habilidad " . $e->getMessage();
    $type = "error";
}
/////////////////////////////////////////////////////////////////////////////////////////



$stmt  = NULL;
$stmt2 = NULL;
$stmt3 = NULL;
$stmt4 = NULL;

if($type == "error")
{
	http_response_code(403);
	echo json_encode(array("mensaje" => "Error al guardar intente nuevamente."));	
}else{
	http_response_code(200);
	echo json_encode(array("id" => $id_char));
}
	
?>