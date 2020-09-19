<?php
error_reporting(E_ALL);
include 'inc/dbconfig.php';

#update values
$search = $_POST['search'];

$db_con = conectar();
$stmt = $db_con->prepare("SELECT id,name FROM sheet_vampire_opt_disciplines WHERE name LIKE '%$search%' LIMIT 5");
//$stmt->bindParam(":search", $search);
$type ="";
try {
   	if($stmt->execute()) 
	{
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
 			echo "<li onclick=\"fillDicipline(".$row['id'].",'".$row['name']."')\">".$row['name']."</li>";
        }
        $db_con = null;

	}else{
		echo "error";
		$db_con = null;
	}
} catch (PDOException $e) {
    $mensaje = "Error, surguio un problema al consultar el vampiro" . $e->getMessage();
    $type = "error";
}

//attr_Dicipline1name 