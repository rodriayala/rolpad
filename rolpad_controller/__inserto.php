<?php

###########################################
#WS:
#Envio (debo especificar el tipo de dato de cada uno ¿?)
#-	Sistema 
#-	Id_sistema
#-	TipoDoc
#-	NroDoc
#-	Apellido
#-	Nombre
#-	Correo electrónico
#-	Vencimiento
#-	Importe
#-	Descripción concepto
#-	Acción= ALTA CONCEPTO / CONSULTA ESTADO
#Devuelve:
#1-	Alta exitosa (ALTA)
#2-	Registro ya existente - duplicado (ALTA)
#3-	Registro Inexistente (CONSULTA ESTADO)
#4-	Registro pagado (CONSULTA ESTADO)
#5-	Registro nopagado (CONSULTA ESTADO)
#99- error en la transacción
###########################################

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include("clases/conn.clas.php");

#echo json_encode(array("mensaje" => "entro"));die;

function getRequestHeaders() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers;
}

$headers 	="";
$header 	="";
$value 		="";

$headers = getRequestHeaders();

foreach ($headers as $header => $value) {

    /*if(trim($header)=="Key")
    {
        $key_recibida  = trim($value);
    }
	if(trim($header)=="Usuario")
    {
        $usuario_recibido  = trim($value);
    }
    if(trim($header)=="Clave")
    {
        //$clave_recibida  = sha1(trim($value));
		$clave_recibida  = trim($value);
    }*/

    if(trim($header)=="Sistema"){ $Sistema = trim($value); }
    if(trim($header)=="Id_sistema"){ $Id_sistema = trim($value); }
    if(trim($header)=="TipoDoc"){ $TipoDoc = trim($value); }
    if(trim($header)=="NroDoc"){ $NroDoc = trim($value); }
    if(trim($header)=="Apellido"){ $Apellido = trim($value); }
    if(trim($header)=="Nombre"){ $Nombre = trim($value); }
    if(trim($header)=="Email"){ $Email = trim($value); }
    if(trim($header)=="Vencimiento"){ $Vencimiento = trim($value); }
    if(trim($header)=="Importe"){ $Importe = trim($value); }
    if(trim($header)=="Concepto"){ $Concepto = trim($value); }
    if(trim($header)=="Accion"){ $Accion = trim($value); }	
}

	$sql_ = "select * from public.accesos where key = '$key_recibida' and usuario = '$usuario_recibido' and clave = '$clave_recibida' ";
	//echo $sql_;	die;
	//echo json_encode(array("mensaje" => "$sql_"));die;
	$conexion_ = new db;  
	$conexion_->conectar();

	$conexion_->ejecutar($sql_);
	
	if (!$conexion_->resultado)
	{
		//echo 'error ';
		$conexion_->desconectar($conexion_);
		http_response_code(403);
		echo json_encode(array("mensaje" => "Error al guardar intente nuevamente."));
	}else{#Usamos la api de ml				
			

		
		http_response_code(200);
	}//Fin inserto
	
?>