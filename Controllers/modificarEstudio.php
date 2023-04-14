<?php 

session_start();

require_once("../Models/conexion.php");
if (empty($_SESSION['active'])) {
		header('location: ../Templates/salir.php');
	}


	if (!empty($_POST)) {
		$alert = '';
	
		if (empty( $_POST['descripcion']) || empty( $_POST['costo'])) {
	
			$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
	
		}else{
	
			$id                 = $_POST['id'];
			$descripcion        = $_POST['descripcion'];
			$costo              = $_POST['costo'];
			
			
	
	
	//echo "SELECT * FROM usuario
	
			//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
	//exit; sirve para ejectuar la consulta en mysql
			$query = mysqli_query($conection,"SELECT * FROM estudios
				WHERE  id != id"
			);
	
			$resultado = mysqli_fetch_array($query);
	
	
		}
	
		if ($resultado > 0) {
			$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';
	
		}else{
	
			$sql_update = mysqli_query($conection,"UPDATE estudios SET descripcion = '$descripcion',costo = '$costo', estado = 1
				WHERE id = $id");
	
			if ($sql_update) {
	
				echo $alert = '<p class = "msg_success">Actualizado Correctamente</p>';
	
			}else{
				echo $alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
			}
		}
	}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Templates/servicios.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM estudios  WHERE id = $id AND estado = 1");   

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location: ../Plantillas/servicios.php");
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		
		$id            = $data['id'];
		$descripcion   = $data['descripcion'];
		$costo         = $data['costo'];
		

	}
}

require_once("../includes/admin_header.php");
?>