<?php
#phpinfo();
ini_set('memory_limit', '-1');
require_once("funciones.php");
require_once('dbconfig.php');
require_once('vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
require_once('vendor/spreadsheet-reader-master/SpreadsheetReader.php');
require_once('ends/uploads3.php');

//error_reporting(0);
error_reporting(E_ALL);
if (falta_logueo())
{ 
	header('location:index.php');
	exit();
}

$usuarioNombre = trim($_SESSION['usu_apellidos']).", ".trim($_SESSION['usu_nombre']); 

$usu_tipo		= trim($_SESSION['usu_tipo']);
if ($usu_tipo!=2)//no es admin
{ 
	header('location: ppal_usuarios.php');
	exit();
}


$type = "";
$message = "";
if($_POST)
{ 

if (isset($_POST["upload"]))
{
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

    //////////////////////////////////////
    $db_con = conectar();
    $stmt_del1 = $db_con->prepare("DELETE FROM `productos_cab` ");
    try{
        if($stmt_del1->execute())
        {
            //$db_con = null;
        }else{
            echo $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_cab".$e->getMessage();
            //errorlog("DELETE FROM `productos_cab`");
            $puedoGuardar = false; $type = "error";die;
        }
    }
    catch(PDOException $e){
        $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_cab".$e->getMessage();
        //errorlog("DELETE FROM `productos_cab`");
        $puedoGuardar = false; $type = "error";die;
        $db_con = null;
    }
    $stmt_del12 = $db_con->prepare("ALTER TABLE productos_cab AUTO_INCREMENT = 1");
    $stmt_del12->execute();
    //$db_con = conectar();
    $stmt_del2 = $db_con->prepare("DELETE FROM `productos_det_1`");
    try{
        if($stmt_del2->execute())
        {
            //$db_con = null;
        }else{
            echo $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_det_1".$e->getMessage();
            //errorlog("DELETE FROM `productos_cab`");
            $puedoGuardar = false; $type = "error";die;
        }
    }
    catch(PDOException $e){
       echo  $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_det_1".$e->getMessage();
        //errorlog("DELETE FROM `productos_det_1`");
        $puedoGuardar = false; $type = "error";die;
        $db_con = null;
    }
    $stmt_del22 = $db_con->prepare("ALTER TABLE productos_det_1 AUTO_INCREMENT = 1");
    $stmt_del22->execute();
    //$db_con = conectar();
    $stmt_del3 = $db_con->prepare("DELETE FROM `productos_det_2` ");
    try{
        if($stmt_del3->execute())
        {
            //$db_con = null;
        }else{
            echo $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_det_2".$e->getMessage();
            //errorlog("DELETE FROM `productos_cab`");
            $puedoGuardar = false; $type = "error";die;
        }
    }
    catch(PDOException $e){
        $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_det_2".$e->getMessage();
        //errorlog("DELETE FROM `productos_det_2`");
        $puedoGuardar = false; $type = "error";die;
        $db_con = null;
    }
    $stmt_del32 = $db_con->prepare("ALTER TABLE productos_det_2 AUTO_INCREMENT = 1");
    $stmt_del32->execute();
    //$db_con = conectar();
    $stmt_del4 = $db_con->prepare("DELETE FROM `productos_det_3` ");
    try{
        if($stmt_del4->execute())
        {
            //$db_con = null;
        }else{
            echo $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_det_3".$e->getMessage();
            //errorlog("DELETE FROM `productos_cab`");
            $puedoGuardar = false; $type = "error";die;
        }
    }
    catch(PDOException $e){
        $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_det_3".$e->getMessage();
        //errorlog("DELETE FROM `productos_det_3`");
        $puedoGuardar = false; $type = "error";die;
        $db_con = null;
    }
    $stmt_del42 = $db_con->prepare("ALTER TABLE productos_det_3 AUTO_INCREMENT = 1");
    $stmt_del42->execute();
    //$db_con = conectar();
    $stmt_del5 = $db_con->prepare("DELETE FROM `productos_det_4` ");
    try{
        if($stmt_del5->execute())
        {
            //$db_con = null;
        }else{
            echo $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_det_4".$e->getMessage();
            //errorlog("DELETE FROM `productos_cab`");
            $puedoGuardar = false; $type = "error";die;
        }
    }
    catch(PDOException $e){
        $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_det_4".$e->getMessage();
        //errorlog("DELETE FROM `productos_det_4`");
        $puedoGuardar = false; $type = "error";die;
        $db_con = null;
    }
    $stmt_del52 = $db_con->prepare("ALTER TABLE productos_det_4 AUTO_INCREMENT = 1");
    $stmt_del52->execute();
    //$db_con = conectar();
    $stmt_del6 = $db_con->prepare("DELETE FROM `productos_det_5`");
    try{
        if($stmt_del6->execute())
        {
            //$db_con = null;
        }else{
            echo $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_det_5".$e->getMessage();
            //errorlog("DELETE FROM `productos_cab`");
            $puedoGuardar = false; $type = "error";die;
        }
    }
    catch(PDOException $e){
        $db_con = null;
        $mensaje = "Error, surguio un problema al eliminar los antiguos registros: productos_det_5".$e->getMessage();
       // errorlog("DELETE FROM `productos_det_5`");
        $puedoGuardar = false; $type = "error";die;
    }

    $stmt_del62 = $db_con->prepare("ALTER TABLE productos_det_5 AUTO_INCREMENT = 1");
    $stmt_del62->execute();
    //////////////////////////////////////
    $db_con = null;


  if(in_array($_FILES["file"]["type"],$allowedFileType))
  {
	  $targetPath = 'uploads/'.$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
    $Reader = new SpreadsheetReader($targetPath);
        
     $sheetCount = count($Reader->sheets()); 

    $puedoGuardar = true;
    if($sheetCount<2) $puedoGuardar = false;


	echo "<div style='display: none'>";
    if($puedoGuardar == true)
    {

        for ($i = 0; $i < $sheetCount; $i++)
        {
            $Reader->ChangeSheet($i);
            $canti = 0;
            foreach ($Reader as $Row)//inserto
            {
                echo  $canti++;
                $A = ""; if (isset($Row[0])) { $A = (trim($Row[0])); }
                $B = ""; if (isset($Row[1])) { $B = (trim($Row[1])); }
                $G = ""; if (isset($Row[6])) { $G = (trim($Row[6])); }
                $H = ""; if (isset($Row[7])) { $H = normaliza(trim($Row[7])); }
                $I = ""; if (isset($Row[8])) { $I = strtoupper(normaliza(trim($Row[8]))); }
                $J = ""; if (isset($Row[9])) { $J = (trim($Row[9])); }
                $K = ""; if (isset($Row[10])) { $K = normaliza(trim($Row[10])); }
                $L = ""; if (isset($Row[11])) { $L = (trim($Row[11])); }
                $M = ""; if (isset($Row[12])) { $M = (trim($Row[12])); }
                $N = ""; if (isset($Row[13])) { $N = (trim($Row[13])); }
                $P = ""; if (isset($Row[15])) { $P = (trim($Row[15])); }
                $Q = ""; if (isset($Row[16])) { $Q = (trim($Row[16])); }
                $R = ""; if (isset($Row[17])) { $R = (trim($Row[17])); }
                $S = ""; if (isset($Row[18])) { $S = (trim($Row[18])); }
                $T = ""; if (isset($Row[19])) { $T = (trim($Row[19])); }
                $X = ""; if (isset($Row[23])) { $X = (trim($Row[23])); }
                $Y = ""; if (isset($Row[24])) { $Y = (trim($Row[24])); }
                $Z = ""; if (isset($Row[25])) { $Z = (trim($Row[25])); }
                $AA = ""; if (isset($Row[26])) { $AA = (trim($Row[26])); }
                $AB = ""; if (isset($Row[27])) { $AB = (trim($Row[27])); }
                $AE = ""; if (isset($Row[30])) { $AE = (trim($Row[30])); }
                $AF = ""; if (isset($Row[31])) { $AF = (trim($Row[31])); }
                $AG = ""; if (isset($Row[32])) { $AG = (trim($Row[32])); }
                $AH = ""; if (isset($Row[33])) { $AH = (trim($Row[33])); }
                $AI = ""; if (isset($Row[34])) { $AI = (trim($Row[34])); }
                $AK = ""; if (isset($Row[36])) { $AK = (trim($Row[36])); }
                $AL = ""; if (isset($Row[37])) { $AL = (trim($Row[37])); }
                $AM = ""; if (isset($Row[38])) { $AM = (trim($Row[38])); }
                $AN = ""; if (isset($Row[39])) { $AN = (trim($Row[39])); }
                $AO = ""; if (isset($Row[40])) { $AO = (trim($Row[40])); }
                $AR = ""; if (isset($Row[43])) { $AR = (trim($Row[43])); }
                $ASS = ""; if (isset($Row[44])) { $ASS = ($Row[44]); }
                $AT = ""; if (isset($Row[45])) { $AT = ($Row[45]);}
                $AU = ""; if (isset($Row[46])) { $AU = ($Row[46]); }
                $AV = ""; if (isset($Row[47])) { $AV = ($Row[47]); }
                $AX = ""; if (isset($Row[49])) { $AX = ($Row[49]); }
                $AY = ""; if (isset($Row[50])) { $AY = ($Row[50]); }
                $AZ = ""; if (isset($Row[51])) { $AZ = ($Row[51]); }
                $BA = ""; if (isset($Row[52])) { $BA = ($Row[52]); }
                $BB = ""; if (isset($Row[53])) { $BB = ($Row[53]); }
                $BE = ""; if (isset($Row[56])) { $BE = ($Row[56]); }
                $BF = ""; if (isset($Row[57])) { $BF = ($Row[57]); }
                $BG = ""; if (isset($Row[58])) { $BG = ($Row[58]); }
                $BH = ""; if (isset($Row[59])) { $BH = ($Row[59]); }
                $BI = ""; if (isset($Row[60])) { $BI = ($Row[60]); }
                $BK = ""; if (isset($Row[62])) { $BK = ($Row[62]); }
                $BL = ""; if (isset($Row[63])) { $BL = ($Row[63]); }
                $BM = ""; if (isset($Row[64])) { $BM = ($Row[64]); }
                $BN = ""; if (isset($Row[65])) { $BN = ($Row[65]); }
                $BO = ""; if (isset($Row[66])) { $BO = ($Row[66]); }

                $BR = ""; if (isset($Row[69])) { $BR = ($Row[69]); }
                $BS = ""; if (isset($Row[70])) { $BS = ($Row[70]); }
                $BT = ""; if (isset($Row[71])) { $BT = ($Row[71]); }
                $BU = ""; if (isset($Row[72])) { $BU = ($Row[72]); }
                $BV = ""; if (isset($Row[73])) { $BV = ($Row[73]); }
                $BX = ""; if (isset($Row[75])) { $BX = ($Row[75]); }
                $BYY = ""; if (isset($Row[76])) { $BYY = ($Row[76]); }
                $BZ = ""; if (isset($Row[77])) { $BZ = ($Row[77]); }
                $CA = ""; if (isset($Row[78])) { $CA = ($Row[78]); }
                $CB = ""; if (isset($Row[79])) { $CB = ($Row[79]); }
                $CD = ""; if (isset($Row[81])) { $CD = ($Row[81]); }


                //if (!empty($I) || !empty($J))//si hay un producto se inserta

               # if( ($canti>6) and (!empty($J)) )
               if(  (!empty($J)) )
                {
                    /*
                    $query = "INSERT INTO `productos_cab`(`B`, `J`, `I`, `K`, `L`, `M`, `N`, `CD`) VALUES ('$B', '$J', '$I', '$K', '$L', '$M', '$N', '$CD')";
                    $result = mysqli_query($conn, $query);

                    //echo "id_cab: ".$id_cab = $result->lastInsertId();
                    //echo "id_cab: ".$id_cab = mysql_insert_id();
                    $id_cab = $conn->insert_id;

                    $query = "INSERT INTO `productos_det_1` (id_cab,`P`, `Q`, `R`, `S`, `T`, `X`, `Y`, `Z`, `AA`, `AB`) VALUES ('$id_cab','$P','$Q','$R','$S','$T','$X','$Y','$Z','$AA','$AB')";
                    $result = mysqli_query($conn, $query);


                    $query = "INSERT INTO `productos_det_2`(`id_cab`, `AE`, `AF`, `AG`, `AH`, `AI`, `AK`, `AL`, `AM`, `AN`, `AO`) VALUES ('$id_cab', '$AE', '$AF', '$AG', '$AH', '$AI', '$AK', '$AL', '$AM', '$AN', '$AO')";
                    $result = mysqli_query($conn, $query);


                    $query = "INSERT INTO `productos_det_3`(`id_cab`, `AR`, `ASS`, `AT`, `AU`, `AV`, `AX`, `AY`, `AZ`, `BA`, `BB`) VALUES ('$id_cab', '$AR', '$ASS', '$AT', '$AU', '$AV', '$AX', '$AY', '$AZ', '$BA', '$BB')";
                 $result = mysqli_query($conn, $query);

                    $query = "INSERT INTO `productos_det_4`(`id_cab`, `BE`, `BF`, `BG`, `BH`, `BI`, `BK`, `BL`, `BM`, `BN`, `BO`) VALUES ('$id_cab', '$BE', '$BF', '$BG', '$BH', '$BI', '$BK', '$BL', '$BM', '$BN', '$BO')";
                    $result = mysqli_query($conn, $query);

                    $query = "INSERT INTO `productos_det_5`(`id_cab`, `BR`, `BS`, `BT`, `BU`, `BV`, `BX`, `BYY`, `BZ`, `CA`, `CB`) VALUES ('$id_cab', '$BR', '$BS', '$BT', '$BU', '$BV', '$BX', '$BYY', '$BZ', '$CA', '$CB')";
                    $result = mysqli_query($conn, $query);
                    /////////////////////////////////////////////////////*/
                    //////////////////////////////////////
                    $db_con = conectar();
                    $stmt = $db_con->prepare("INSERT INTO `productos_cab`(`B`,`G`,`H`, `J`, `I`, `K`, `L`, `M`, `N`, `CD`) VALUES (:B, :G, :H, :J, :I, :K, :L, :M, :N, :CD)");
                    //$stmt->bindParam(":id_cab", 'NULL');
                    $stmt->bindParam(":B", $B);
                    $stmt->bindParam(":G", $G);
                    $stmt->bindParam(":H", $H);
                    $stmt->bindParam(":J", $J);
                    $stmt->bindParam(":I", $I);
                    $stmt->bindParam(":K", $K);
                    $stmt->bindParam(":L", $L);
                    $stmt->bindParam(":M", $M);
                    $stmt->bindParam(":N", $N);
                    $stmt->bindParam(":CD", $CD);
                    //var_dump($stmt); die;
                  
      try {
                    if ($stmt->execute())//SI PUDO AGREGAR LA CABECERA CONTINUO GUARDANDO
                   {
                        //echo "Registro agregado correctamente";
                        //echo "id_cab: ".
                        //$id_cab = $db_con->lastInsertId();
                        $stmt = $db_con->query("SELECT LAST_INSERT_ID()");
                        $id_cab = $stmt->fetchColumn();
                        //////////////////////////////////////	productos_det_1
                        $stmt0 = $db_con->prepare("INSERT INTO `productos_det_1` (id_cab,`P`, `Q`, `R`, `S`, `T`, `X`, `Y`, `Z`, `AA`, `AB`) VALUES (:id_cab,:P,:Q,:R,:S,:T,:X,:Y,:Z,:AA,:AB)");

                        $stmt0->bindParam(":id_cab", $id_cab);
                        $stmt0->bindParam(":P", $P);
                        $stmt0->bindParam(":Q", $Q);
                        $stmt0->bindParam(":R", $R);
                        $stmt0->bindParam(":S", $S);
                        $stmt0->bindParam(":T", $T);
                        $stmt0->bindParam(":X", $X);
                        $stmt0->bindParam(":Y", $Y);
                        $stmt0->bindParam(":Z", $Z);
                        $stmt0->bindParam(":AA", $AA);
                        $stmt0->bindParam(":AB", $AB);

                        try {
                            if ($stmt0->execute()) {
                            }
                        } catch (PDOException $e) {
                            //errorlog("INSERT INTO `productos_det_1` (id_cab,`P`, `Q`, `R`, `S`, `T`, `X`, `Y`, `Z`, `AA`, `AB`) VALUES ('$id_cab','$P','$Q','$R','$S','$T','$X','$Y','$Z','$AA','$AB')");
                            $mensaje = "Error, surguio un problema al agregar el registro" . $e->getMessage();
                            $type = "error";
                        }
                        //////////////////////////////////////	productos_det_1

                        //////////////////////////////////////	productos_det_2
                        $stmt2 = $db_con->prepare("INSERT INTO `productos_det_2`(`id_cab`, `AE`, `AF`, `AG`, `AH`, `AI`, `AK`, `AL`, `AM`, `AN`, `AO`) VALUES (:id_cab2, :AE, :AF, :AG, :AH, :AI, :AK, :AL, :AM, :AN, :AO)");

                        $stmt2->bindParam(":id_cab2", $id_cab);
                        $stmt2->bindParam(":AE", $AE);
                        $stmt2->bindParam(":AF", $AF);
                        $stmt2->bindParam(":AG", $AG);
                        $stmt2->bindParam(":AH", $AH);
                        $stmt2->bindParam(":AI", $AI);
                        $stmt2->bindParam(":AK", $AK);
                        $stmt2->bindParam(":AL", $AL);
                        $stmt2->bindParam(":AM", $AM);
                        $stmt2->bindParam(":AN", $AN);
                        $stmt2->bindParam(":AO", $AO);

                        try {
                            if ($stmt2->execute()) {
                            }
                        } catch (PDOException $e) {
                            //errorlog("INSERT INTO `productos_det_2`(`id_cab`, `AE`, `AF`, `AG`, `AH`, `AI`, `AK`, `AL`, `AM`, `AN`, `AO`) VALUES ('$id_cab', '$AE', '$AF', '$AG', '$AH', '$AI', '$AK', '$AL', '$AM', '$AN', '$AO')");
                            $mensaje = "Error, surguio un problema al agregar el registro" . $e->getMessage();
                            $type = "error";
                        }
                        //////////////////////////////////////	productos_det_2

                        //////////////////////////////////////	productos_det_3
                        $stmt3 = $db_con->prepare("INSERT INTO `productos_det_3`(`id_cab`, `AR`, `ASS`, `AT`, `AU`, `AV`, `AX`, `AY`, `AZ`, `BA`, `BB`) VALUES (:id_cab, :AR, :ASS, :AT, :AU, :AV, :AX, :AY, :AZ, :BA, :BB)");

                        $stmt3->bindParam(":id_cab", $id_cab);
                        $stmt3->bindParam(":AR", $AR);
                        $stmt3->bindParam(":ASS", $ASS);
                        $stmt3->bindParam(":AT", $AT);
                        $stmt3->bindParam(":AU", $AU);
                        $stmt3->bindParam(":AV", $AV);
                        $stmt3->bindParam(":AX", $AX);
                        $stmt3->bindParam(":AY", $AY);
                        $stmt3->bindParam(":AZ", $AZ);
                        $stmt3->bindParam(":BA", $BA);
                        $stmt3->bindParam(":BB", $BB);

                        try {
                            if ($stmt3->execute()) {
                            }
                        } catch (PDOException $e) {
                            //errorlog("INSERT INTO `productos_det_3`(`id_cab`, `AR`, `ASS`, `AT`, `AU`, `AV`, `AX`, `AY`, `AZ`, `BA`, `BB`) VALUES ('$id_cab', '$AR', '$ASS', '$AT', '$AU', '$AV', '$AX', '$AY', '$AZ', '$BA', '$BB')");
                            $mensaje = "Error, surguio un problema al agregar el registro" . $e->getMessage();
                            $type = "error";
                        }
                        //////////////////////////////////////	productos_det_3

                        //////////////////////////////////////	productos_det_4
                        $stmt4 = $db_con->prepare("INSERT INTO `productos_det_4`(`id_cab`, `BE`, `BF`, `BG`, `BH`, `BI`, `BK`, `BL`, `BM`, `BN`, `BO`) VALUES (:id_cab, :BE, :BF, :BG, :BH, :BI, :BK, :BL, :BM, :BN, :BO)");

                        $stmt4->bindParam(":id_cab", $id_cab);
                        $stmt4->bindParam(":BE", $BE);
                        $stmt4->bindParam(":BF", $BF);
                        $stmt4->bindParam(":BG", $BG);
                        $stmt4->bindParam(":BH", $BH);
                        $stmt4->bindParam(":BI", $BI);
                        $stmt4->bindParam(":BK", $BK);
                        $stmt4->bindParam(":BL", $BL);
                        $stmt4->bindParam(":BM", $BM);
                        $stmt4->bindParam(":BN", $BN);
                        $stmt4->bindParam(":BO", $BO);

                        try {
                            if ($stmt4->execute()) {
                            }
                        } catch (PDOException $e) {
                            //errorlog("INSERT INTO `productos_det_4`(`id_cab`, `BE`, `BF`, `BG`, `BH`, `BI`, `BK`, `BL`, `BM`, `BN`, `BO`) VALUES ('$id_cab', '$BE', '$BF', '$BG', '$BH', '$BI', '$BK', '$BL', '$BM', '$BN', '$BO')");
                            $mensaje = "Error, surguio un problema al agregar el registro" . $e->getMessage();
                            $type = "error";
                        }
                        //////////////////////////////////////	productos_det_4

                        //////////////////////////////////////	productos_det_5
                        $stmt5 = $db_con->prepare("INSERT INTO `productos_det_5`(`id_cab`, `BR`, `BS`, `BT`, `BU`, `BV`, `BX`, `BYY`, `BZ`, `CA`, `CB`) VALUES (:id_cab, :BR, :BS, :BT, :BU, :BV, :BX, :BYY, :BZ, :CA, :CB)");

                        $stmt5->bindParam(":id_cab", $id_cab);
                        $stmt5->bindParam(":BR", $BR);
                        $stmt5->bindParam(":BS", $BS);
                        $stmt5->bindParam(":BT", $BT);
                        $stmt5->bindParam(":BU", $BU);
                        $stmt5->bindParam(":BV", $BV);
                        $stmt5->bindParam(":BX", $BX);
                        $stmt5->bindParam(":BYY", $BYY);
                        $stmt5->bindParam(":BZ", $BZ);
                        $stmt5->bindParam(":CA", $CA);
                        $stmt5->bindParam(":CB", $CB);

                        try {
                            if ($stmt5->execute()) {
                            }
                        } catch (PDOException $e) {
                            //errorlog("INSERT INTO `productos_det_5`(`id_cab`, `BR`, `BS`, `BT`, `BU`, `BV`, `BX`, `BYY`, `BZ`, `CA`, `CB`) VALUES ('$id_cab', '$BR', '$BS', '$BT', '$BU', '$BV', '$BX', '$BYY', '$BZ', '$CA', '$CB')");
                            $mensaje = "Error, surguio un problema al agregar el registro" . $e->getMessage();
                            $type = "error";
                        }
                        //////////////////////////////////////	productos_det_5
                    }
        
            } catch (PDOException $e) {
                           
                $mensaje = "Error, surguio un problema al agregar el registro" . $e->getMessage();
                $type = "error";
            }
                /*else {//fin guardo cabecera
                        $message = "Error, surguio un problema al ingresar la cabecera";
                        $type = "error";
                    }*/

                    $type = "exito";
                    $message = "Excel Importado Correctamente";
					//actualizoS3();
                }//fin si hay un producto
            }

        //}
        }
		
	  echo "<script>
	  			$(document).ready(function() {	
					$('a').hide_modal(); 
				 });
			</script>";

    }else {//Fin puedo guardar
        $type = "error";
        $message = "Tipo de Archivo Incorrecto. Asegurece de subir un Archivo Excel valido.";
    }
    echo "</div>";
  }else{
        $type = "error";
        $message = "Tipo de Archivo Incorrecto. Asegurece de subir un Archivo Excel valido.";
  }
}


}//fin post

?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="ISO-8859-1">

        <title>DI DONATO DISTRIBUCION</title>

        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="css/bootstrap.css">

        <!-- Related styles of various javascript plugins -->
        <link rel="stylesheet" href="css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="css/main.css">

        <!-- Load a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src="js/vendor/modernizr-respond.min.js"></script>
    </head>

    <!-- Add the class .fixed to <body> for a fixed layout on large resolutions (min: 1200px) -->
    <!-- <body class="fixed"> -->
    <body>
        <!-- Page Container -->
        <div id="page-container">
            <!-- Header -->
            <!-- Add the class .navbar-fixed-top or .navbar-fixed-bottom for a fixed header on top or bottom respectively -->
            <!-- <header class="navbar navbar-inverse navbar-fixed-top"> -->
            <!-- <header class="navbar navbar-inverse navbar-fixed-bottom"> -->
            <header class="navbar navbar-inverse">
                <!-- Mobile Navigation, Shows up  on smaller screens -->
                <ul class="navbar-nav-custom pull-right hidden-md hidden-lg">
                    <li class="divider-vertical"></li>
                    <li>
                        <!-- It is set to open and close the main navigation on smaller screens. The class .navbar-main-collapse was added to aside#page-sidebar -->
                        <a href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-main-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
                <!-- END Mobile Navigation -->

                <!-- Logo -->
                <a href="ppal_usuarios.php" class="navbar-brand"><img src="img/logo_mini_mini.png" alt="logo"></a>

                <!-- Loading Indicator, Used for demostrating how loading of widgets could happen, check main.js - uiDemo() -->
                <div id="loading" class="pull-left"><i class="fa fa-certificate fa-spin"></i></div>

                <!-- Header Widgets -->
                <!-- You can create the widgets you want by replicating the following. Each one exists in a <li> element -->
                <ul id="widgets" class="navbar-nav-custom pull-right">
                    <li class="divider-vertical"></li>

                    <!-- User Menu -->
                    <li class="dropdown pull-right dropdown-user">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Usuario: <?php echo $usuarioNombre; ?> </a>
                        
                    </li>
                    <!-- END User Menu -->
					
                </ul>
                <!-- END Header Widgets -->
            </header>
            <!-- END Header -->

            <!-- Inner Container -->
            <div id="inner-container">
                <!-- Sidebar -->
                <aside id="page-sidebar" class="collapse navbar-collapse navbar-main-collapse">
                    <!-- Sidebar search -->
                    <form id="sidebar-search" action="page_search_results.html" method="post">
                        <div class="input-group">
                            
                        </div>
                    </form>
                    <!-- END Sidebar search -->

                    <!-- Primary Navigation -->
                    <nav id="primary-nav">
                      <?php include('menu_admin.php'); ?>
                    </nav>
                    <!-- END Primary Navigation -->

                </aside>
                <!-- END Sidebar -->

                <!-- Page Content -->
                <div id="page-content">
                    <!-- Navigation info -->
                    <ul id="nav-info" class="clearfix">
                        <li><a href="ppal_usuarios.php"><i class="fa fa-home"></i></a></li>
                    </ul>
                    <!-- END Navigation info -->

                    <!-- FORMULARIO -->
                   
                    <h4 class="form-box-header">CARGA DE INFORMACIÓN</h4>

					<?php if($type=="error"){?>
                    <div class="alert alert-danger" role="alert">
						<?php echo $message; ?>	
					</div>
					<?php } ?>
                    
                    <?php if($type=="exito"){?>
                    <div class="alert alert-success" role="alert">
						<?php echo $message; ?>	
					</div>
					<?php } ?>
					<div class="row">
                        <!-- formulario -->
                        <div class="col-sm-12">
						<form action="" method="post" enctype="multipart/form-data" class="form-horizontal form-box">
                        <h4 class="form-box-header">SUBIR ARCHIVO EXCEL</h4>
                            <div class="form-box-content">
                                <div class="form-group">
                                    <label class="control-label col-md-7" for="example-file">Recuerde Agregar el Archivo en formato Excel </label>
                                    <div class="col-md-4">                
                                       <input type="file" name="file" id="file" accept=".xls,.xlsx" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-actions">
                                    <div class="col-md-10 col-md-offset-2" align="right">
                                        <button class="btn btn-danger" id="cancel">Cancelar</button>
                                        <button type="submit" class="btn btn-success" name="upload" id="upload" ><i class="fa fa-arrow-circle-o-up"></i> Subir</button>
                                    </div>
                                </div>
                            </div>
                    	</form>                            
                            
                        </div>
                        <!-- fin formular-->

                        <!-- Column 2 of Row 3 --><!-- END Column 2 of Row 3 -->
                    </div>
                                            
                    
                    <!-- END FORMULARIO -->

                </div>
                <!-- END Page Content -->

                <!-- Footer -->
                <footer>
                   2019 &copy; <strong>Di Donato Distribucion</strong>
                </footer>
                <!-- END Footer -->
            </div>
            <!-- END Inner Container -->
        </div>
        <!-- END Page Container -->

        
        </div>
        <!-- END User Modal Settings -->




        <!-- Excanvas for canvas support on IE8 -->
        <!--[if lte IE 8]><script src="js/helpers/excanvas.min.js"></script><![endif]-->

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js -->
        <script src="js/vendor/bootstrap.min.js"></script>

        <!-- Jquery plugins and custom javascript code -->
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- ckeditor.js, load it only in the page you would like to use CKEditor (it's a heavy plugin to include it with the others!) -->
        <script src="js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="js/sweetalert2.all.js"></script>

        <script type="text/javascript">
        /*MENSAJES*/

        var type = '<?php echo $type; ?>' ;
        var Mensaje = '<?php echo $message; ?>' ;

        if(type=="error")
        {
            swal({
            title: "Oopss..",
            text: Mensaje,
            type: "error"
            },
            function(){
                window.location.href = 'carga.php';
            });
        }
        if(type=="exito")
        {
            swal({
                    title: "FELICITACIONES",
                    text: Mensaje,
                    type: "success"
                },
                function(){
                    window.location.href = 'ppal_admin.php';
                });
        }
        </script>
    </body>
</html>