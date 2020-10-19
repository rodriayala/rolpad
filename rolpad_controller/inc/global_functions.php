<?php

function audit($id_char,$new_value,$old_value,$table_char,$table_id,$html_tag)
{

	$db_con_au = conectar();
	$stmt_au = $db_con_au->prepare("INSERT INTO `audit_chars`(`id_char`, `old_value`, `new_value`, `table_name`, `table_id`, `html_tag`) VALUES (:id_char,:old_value,:new_value,:table_char,:table_id,:html_tag)");
	//echo "INSERT INTO `audit_chars`(`id_char`, `old_value`, `new_value`, `table_name`, `table_id`) VALUES ($id_char,$old_value,$new_value,$table_char,$table_id,$html_tag)";
	$stmt_au->bindParam(":id_char", $id_char);
	$stmt_au->bindParam(":new_value", $new_value);
	$stmt_au->bindParam(":old_value", $old_value);	
	$stmt_au->bindParam(":table_char", $table_char);
	$stmt_au->bindParam(":table_id", $table_id);
	$stmt_au->bindParam(":html_tag", $html_tag);

	try {
	 	$stmt_au->execute();
	} catch (PDOException $e) {
	    $mensaje = "Error, audit " . $e->getMessage();
	}

	$stmt_au =NULL;
}
