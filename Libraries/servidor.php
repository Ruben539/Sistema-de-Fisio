<?php

require_once("mysql.php");

$oMysql = new MYSQL();

$respuesta = "";
if($_POST){ 
$rq = $_POST['rq'];
}
if($rq == 1){
	$respuesta = $oMysql->TotalPacientesDiarios();

}elseif ($rq == 2){
	$respuesta = $oMysql->TotalPacientesMensuales();

}elseif ($rq == 3){
	$respuesta = $oMysql->TotalIngresosDiarios();
}elseif ($rq == 4){
	$respuesta = $oMysql->TotalIngresosMensuales();
}
echo $respuesta;



