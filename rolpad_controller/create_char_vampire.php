<?php
include("inc/dbconfig.php");
include 'inc/global_functions.php';
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
    if ($stmt->execute())
    {
		$stmt 	= $db_con->query("SELECT LAST_INSERT_ID()");
        $id_char = $stmt->fetchColumn(); 

        audit($id_char,'User Number: ','0','sheet_vampire_chars',$id_char,'Vampire Create','create');
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
/////////////////////////////////////////////////////////////////////////////////////////virtues
$db_con6 = conectar();
$stmt6 	 = $db_con6->prepare("SELECT * FROM `sheet_vampire_opt_virtues` WHERE true ORDER BY `id`  ASC ");

try {
	$stmt6->execute();
    while($row6=$stmt6->fetch(PDO::FETCH_ASSOC))
    {
		$id_vi 			= $row6['id']; 
		$actual_value 	= 1;
		$selected 		= 1;

		$db_con7 = conectar();
		$stmt7 	 = $db_con7->prepare("INSERT INTO `sheet_vampire_chars_virtues`(`id_char`, `id_vi`, `actual_value`, `selected`) VALUES (:id_char,:id_vi,:actual_value,:selected)");

		$stmt7->bindParam(":id_char", $id_char);
		$stmt7->bindParam(":id_vi", $id_vi);
		$stmt7->bindParam(":actual_value", $actual_value);
		$stmt7->bindParam(":selected", $selected);
		$stmt7->execute();
    }
 } catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al crear la virtud " . $e->getMessage();
    $type = "error";
}

////////////////////////////////////////////////////////////////////////////////////////end virtues	

/////////////////////////////////////////////////////////////////////////////////////////damage
$db_con8 = conectar();
$stmt8	 = $db_con7->prepare("SELECT * FROM `sheet_vampire_opt_damage` WHERE true ORDER BY `id`  ASC ");

try {
	$stmt8->execute();
    while($row8=$stmt8->fetch(PDO::FETCH_ASSOC))
    {
		$id_opt_d 	= $row8['id']; 
		$value 		= 0;

		$db_con9 = conectar();
		$stmt9 	 = $db_con9->prepare("INSERT INTO `sheet_vampire_chars_damage`(`id_char`, `id_opt_d`, `value`) VALUES (:id_char,:id_opt_d,:value)");

		$stmt9->bindParam(":id_char", $id_char);
		$stmt9->bindParam(":id_opt_d", $id_opt_d);
		$stmt9->bindParam(":value", $value);
		$stmt9->execute();
    }
 } catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al crear la virtud " . $e->getMessage();
    $type = "error";
}

////////////////////////////////////////////////////////////////////////////////////////end damage	

$stmt  = NULL;
$stmt2 = NULL;
$stmt3 = NULL;
$stmt4 = NULL;
$stmt5 = NULL;
$stmt6 = NULL;
$stmt7 = NULL;
$stmt8 = NULL;
$stmt9 = NULL;

if($type == "error")
{
	http_response_code(403);
	echo json_encode(array("mensaje" => "Error al guardar intente nuevamente. $mensaje"));	
}else{
	http_response_code(200);
	echo json_encode(array("id" => $id_char));
}
	
?>