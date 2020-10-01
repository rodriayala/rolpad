<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';

#echo json_encode(array("mensaje" => "entro"));die;

#get default values
$id_char = $_POST['id_char'];

$db_con = conectar();
$stmt = $db_con->prepare("SELECT * FROM `sheet_vampire_chars` WHERE id_char = :id_char");
$stmt->bindParam(":id_char", $id_char);

#$json_res[] ="";
$json_res =['char' => array()];
$type ="";
try {
   	if ($stmt->execute()) 
	{
	   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	   {
			$is_npc 	= trim($row['is_npc']); 
			$name 		= trim($row['name']);
			$nature 	= trim($row['nature']);
			$demeanor 	= trim($row['demeanor']);
			$concept 	= trim($row['concept']);
			$clan 		= trim($row['clan']);
			$generation = trim($row['generation']);
			$sire 		= trim($row['sire']);
			$humanity_path 		= trim($row['humanity_path']);
			$humanity_total 	= trim($row['humanity_total']);
			$willpower_total 	= trim($row['willpower_total']);
			$willpower_subtotal = trim($row['willpower_subtotal']);
			$bloodpool_total 	= trim($row['bloodpool_total']);
			$bloodpool_used 	= trim($row['bloodpool_used']);
			$experience 		= trim($row['experience']);
			$is_npc	 			= trim($row['is_npc']);

			 $json_res_init = array(array("vampire"=>array(
								"id_char" => $id_char,
								"name_char" => "$name",							
								"nature" => "$nature",
								"demeanor" => "$demeanor",
								"concept" => "$concept",
								"clan" => "$clan",
								"generation" => "$generation",
								"sire" => "$sire",
								"humanity_path" => "$humanity_path",
								"humanity_total" => $humanity_total,
								"willpower_total" => $willpower_total,
								"willpower_subtotal" => $willpower_subtotal,
								"bloodpool_total" => $bloodpool_total,
								"bloodpool_used" => $bloodpool_used,
								"experience" => $experience,
								"is_npc" => $is_npc								
								)
			 				));
			#$json_res[] = $json_res_init;	
			//$json_res =['vampire' => array($json_res_init)];
			$json_res["char"][] = $json_res_init;				
	    }//end while

	}
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}
//echo json_encode($json_res);die;
//var_dump($json_res); die;
##########################################################################################Attributes
	$db_con_at = conectar();
	$stmt_at = $db_con_at->prepare("SELECT *, sheet_vampire_chars_attributes.id as id_opt_at FROM `sheet_vampire_chars_attributes` INNER JOIN sheet_vampire_opt_attributes ON sheet_vampire_opt_attributes.id_ab= sheet_vampire_chars_attributes.id_at where sheet_vampire_chars_attributes.id_char = :id_char order BY sheet_vampire_opt_attributes.id_ab");
	$stmt_at->bindParam(":id_char", $id_char);

	try{
		if($stmt_at->execute())
		{
			$_row_at = $stmt_at->fetchAll();	

		}
	}catch(PDOException $e){
			$message = "Error, surguio un problema al cargar la informacion".$e->getMessage(); $type = "error";
			$db_con_at = null;
	}

	$arrayAttributes=NULL;
	foreach($_row_at as $arr_at)
	{
		$id 			= trim($arr_at['id']);//is for default value
		$name 			= trim($arr_at['name']);
		$actual_value 	= trim($arr_at['actual_value']);
		$column_al 		= trim($arr_at['column_al']);
		$html_tag 		= trim($arr_at['html_tag']);

		$json_res_par_at= array("attributes"=>array(											
													"id" => $id,
													"name" => $name,
													"actual_value" => $actual_value,
													"column_al" => $column_al,
													"html_tag" => $html_tag
												 )
										
							);
		$arrayAttributes[] = $json_res_par_at;
	}
##########################################################################################Attributes
$json_res["char"][] = $arrayAttributes;
#var_dump($json_res); die;
##########################################################################################
	$db_con_ab = conectar();
	$stmt_ab = $db_con_ab->prepare("SELECT *, sheet_vampire_chars_abilities.id as id_opt_ab FROM `sheet_vampire_chars_abilities`
	INNER JOIN sheet_vampire_opt_abilities ON sheet_vampire_opt_abilities.id = sheet_vampire_chars_abilities.id_ab
	where sheet_vampire_chars_abilities.id_char =:id_char
	order BY sheet_vampire_opt_abilities.id");
	$stmt_ab->bindParam(":id_char", $id_char);

	try{
		if($stmt_ab->execute())
		{
			$_row_ab = $stmt_ab->fetchAll();	

		}
	}catch(PDOException $e){
			$message = "Error, surguio un problema al cargar la informacion".$e->getMessage(); $type = "error";
			$db_con_ab = null;
	}

	$arrayabilities=NULL;
	foreach($_row_ab as $arr_ab)
	{
		//$id 		= trim($row2['id']);//is for default value
		$name 			= trim($arr_ab['name']);
		$actual_value 	= trim($arr_ab['actual_value']);
		$column_al 		= trim($arr_ab['column_al']);
		$is_masquerade 	= trim($arr_ab['is_masquerade']);
		$is_concealable = trim($arr_ab['is_concealable']);
		$id_opt_ab 		= trim($arr_ab['id_opt_ab']);
		$html_tag 		= trim($arr_ab['html_tag']);

		$json_res_par_ab= array("abilities"=>array(											
													"id" => $id_opt_ab,
													"name" => $name,
													"actual_value" => $actual_value,
													"column_al" => $column_al,
													"is_masquerade" => $is_masquerade,
													"is_concealable" => $is_concealable,
													"html_tag" => $html_tag
												 )
										
							);
		$arrayabilities[] = $json_res_par_ab;
	}
##########################################################################################
$json_res["char"][] = $arrayabilities;
#var_dump($json_res); die;
##########################################################################################
	$db_con_dis = conectar();
	$stmt_dis = $db_con_dis->prepare("SELECT *, sheet_vampire_chars_disciplines.id as id_opt_di FROM `sheet_vampire_chars_disciplines`
	INNER JOIN sheet_vampire_opt_disciplines ON sheet_vampire_opt_disciplines.id = sheet_vampire_chars_disciplines.id_di
	where sheet_vampire_chars_disciplines.id_char =:id_char
	order BY sheet_vampire_opt_disciplines.id");
	$stmt_dis->bindParam(":id_char", $id_char);

	try{
		if($stmt_dis->execute())
		{
			$_row_dis = $stmt_dis->fetchAll();	

		}
	}catch(PDOException $e){
		$message = "Error, surguio un problema al cargar la informacion".$e->getMessage(); $type = "error";
		$db_con_dis = null;
	}

	$arrayadisciplines=NULL;
	foreach($_row_dis as $arr_dis)
	{
		$id 			= trim($arr_dis['id_di']);//is for default value
		$name 			= trim($arr_dis['name']);
		$actual_value 	= trim($arr_dis['actual_value']);
		$id_opt_di 		= trim($arr_dis['id_opt_di']);

		$json_res_par_dis= array("disciplines"=>array(											
													"id_opt_di" => $id,
													"name" => $name,
													"actual_value" => $actual_value,
													"column_al" => $column_al,
													"is_masquerade" => $is_masquerade,
													"is_concealable" => $is_concealable
												 )
										
							);
		$arrayadisciplines[] = $json_res_par_dis;
	}
##########################################################################################
if($arrayadisciplines!=NULL) #$json_res = $json_res + $arrayadisciplines;
	$json_res["char"][] = $arrayadisciplines;
#var_dump(($json_res)); die;
##########################################################################################
	$db_con_bac = conectar();
	$stmt_bac = $db_con_bac->prepare("SELECT *, sheet_vampire_chars_backgrounds.id as id_opt_ba FROM `sheet_vampire_chars_backgrounds`
	INNER JOIN sheet_vampire_opt_backgrounds ON sheet_vampire_opt_backgrounds.id = sheet_vampire_chars_backgrounds.id_bac
	where sheet_vampire_chars_backgrounds.id_char =:id_char
    and sheet_vampire_opt_backgrounds.is_masquerade = 1
	order BY sheet_vampire_opt_backgrounds.id");
	$stmt_bac->bindParam(":id_char", $id_char);

	try{
		if($stmt_bac->execute())
		{
			$_row_bac = $stmt_bac->fetchAll();	

		}
	}catch(PDOException $e){
		$message = "Error, surguio un problema al cargar la informacion".$e->getMessage(); $type = "error";
		$db_con_bac = null;
	}

	$arrayabackgrounds=NULL;
	foreach($_row_bac as $arr_bac)
	{
		$id 			= trim($arr_bac['id_bac']);//is for default value
		$name 			= trim($arr_bac['name']);
		$actual_value 	= trim($arr_bac['actual_value']);
		$is_masquerade 	= trim($arr_bac['is_masquerade']);
		$id_opt_ba 		= trim($arr_bac['id_opt_ba']);

		$json_res_par_bac= array("backgrounds"=>array(	
													//"id" => $id,										
													"id_opt_ba" => $id,
													"name" => $name,
													"actual_value" => $actual_value,
													"is_masquerade" => $is_masquerade
												 )
										
							);
		$arrayabackgrounds[] = $json_res_par_bac;
	}
##########################################################################################
if($arrayabackgrounds!=NULL) #$json_res = $json_res + $arrayabackgrounds;
$json_res["char"][] = $arrayabackgrounds;
##########################################################################################
	$db_con_oth = conectar();
	$stmt_oth = $db_con_oth->prepare("SELECT *, sheet_vampire_chars_chars_others.id as id_opt_co FROM `sheet_vampire_chars_chars_others`
	INNER JOIN sheet_vampire_opt_chars_others ON sheet_vampire_opt_chars_others.id = sheet_vampire_chars_chars_others.id_co
	where sheet_vampire_chars_chars_others.id_char =:id_char
	order BY sheet_vampire_opt_chars_others.id");
	$stmt_oth->bindParam(":id_char", $id_char);

	try{
		if($stmt_oth->execute())
		{
			$_row_oth = $stmt_oth->fetchAll();	

		}
	}catch(PDOException $e){
		$message = "Error, surguio un problema al cargar la informacion".$e->getMessage(); $type = "error";
		$db_con_oth = null;
	}

	$arrayachars_others=NULL;
	foreach($_row_oth as $arr_oth)
	{
		//$id 			= trim($arr_oth['id']);//is for default value
		$name 			= trim($arr_oth['name']);
		$actual_value 	= trim($arr_oth['actual_value']);
		$id_opt_co 		= trim($arr_oth['id_opt_co']);

		$json_res_par_co= array("chars_others"=>array(											
													"id_opt_co" => $id_opt_co,
													"name" => $name,
													"actual_value" => $actual_value
												 )
										
							);
		$arrayachars_others[] = $json_res_par_co;
	}
##########################################################################################
if($arrayachars_others!=NULL) #$json_res = $json_res + $arrayachars_others;
$json_res["char"][] = $arrayachars_others;
##########################################################################################
	$db_con_dam = conectar();
	$stmt_dam = $db_con_dam->prepare("SELECT *, sheet_vampire_chars_damage.id as id_dam FROM `sheet_vampire_chars_damage`
	INNER JOIN sheet_vampire_opt_damage ON sheet_vampire_opt_damage.id = sheet_vampire_chars_damage.id_opt_d
	where sheet_vampire_chars_damage.id_char =:id_char
	order BY sheet_vampire_opt_damage.id");
	$stmt_dam->bindParam(":id_char", $id_char);

	try{
		if($stmt_dam->execute())
		{
			$_row_dam = $stmt_dam->fetchAll();	

		}
	}catch(PDOException $e){
		$message = "Error, surguio un problema al cargar la informacion".$e->getMessage(); $type = "error";
		$db_con_dam = null;
	}

	$arrayDamage=NULL;
	foreach($_row_dam as $arr_dam)
	{
		$id 		= trim($arr_dam['id']);//is for default value
		$name 		= trim($arr_dam['name']);
		$value 		= trim($arr_dam['value']);
		$id_opt_ab 	= trim($arr_dam['id_opt_d']);
		$penalty 	= trim($arr_dam['penalty']);

		$json_res_par_dam= array("damage"=>array(											
													"id" => $id,
													"name" => $name,
													"value" => $value,
													"penalty" => $penalty													
												 )
										
							);
		$arrayDamage[] = $json_res_par_dam;
	}
##########################################################################################
if($arrayDamage!=NULL) #$json_res = $json_res + $arrayDamage;
$json_res["char"][] = $arrayDamage;
##########################################################################################
	$db_con_vi = conectar();
	$stmt_vi = $db_con_vi->prepare("SELECT *, sheet_vampire_chars_virtues.id as id_cv FROM sheet_vampire_chars_virtues
	INNER JOIN sheet_vampire_opt_virtues ON sheet_vampire_opt_virtues.id = sheet_vampire_chars_virtues.id_vi
	where sheet_vampire_chars_virtues.id_char =:id_char
	order BY sheet_vampire_opt_virtues.id");
	$stmt_vi->bindParam(":id_char", $id_char);

	try{
		if($stmt_vi->execute())
		{
			$_row_vi = $stmt_vi->fetchAll();
		}
	}catch(PDOException $e){
		$message = "Error, surguio un problema al cargar la informacion".$e->getMessage(); $type = "error";
		$db_con_vi = null;
	}

	$arrayVirtues=NULL;
	foreach($_row_vi as $arr_vi)
	{
		$id_vi 		= trim($arr_vi['id_vi']);//is for default value
		$name 		= trim($arr_vi['name']);
		$value 		= trim($arr_vi['actual_value']);
		$id_cv	 	= trim($arr_vi['id_cv']);

		$json_res_par_vi= array("virtues"=>array(											
													"id_vi" => $id_vi,//position
													"id" => $id_cv,
													"name" => $name,
													"value" => $value
												 )
										
							);
		$arrayVirtues[] = $json_res_par_vi;
	}
##########################################################################################
if($arrayVirtues!=NULL) #$json_res = $json_res + $arrayVirtues;
$json_res["char"][] = $arrayVirtues;

//var_dump($json_res); die;
$stmt  		= NULL;
$stmt_at 	= NULL;
$stmt0		= NULL;
$stmt_dis 	= NULL;
$stmt_bac 	= NULL;
$stmt_oth 	= NULL;
$stmt_dam 	= NULL;
$stmt_vi 	= NULL;

if($type == "error")
{
	http_response_code(403);
	echo json_encode(array("mensaje" => "Error al consultar intente nuevamente."));	
}else{
	http_response_code(200);
	echo json_encode($json_res);
}
	
?>