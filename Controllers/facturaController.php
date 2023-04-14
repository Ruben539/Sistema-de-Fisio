<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
    if (empty($_SESSION['active'])) {
        header('location: ../Templates/salir.php');
    }
    require_once("../Models/conexion.php");
    $alert = '';

    //print_r($_POST);
    //print_r($_FILES);
    //exit;
    if (!empty($_POST)) {
        if (
            empty($_POST['paciente_id']) || empty($_POST['estudio_id']) || empty($_POST['monto']) ||  empty($_POST['metodo_pago_id'])) {

            $alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
        } else {


            $paciente_id     = $_POST['paciente_id'];
            $estudio_id      = $_POST['estudio_id'];
            $sesion_id       = $_POST['sesion_id'];
            $monto           = $_POST['monto'];
            $descuento       = $_POST['descuento'];
            $metodo_pago_id  = $_POST['metodo_pago_id'];
            $forma_pago_id   = $_POST['forma_pago_id'];
            $porcentaje      = $_POST['porcentaje'];
            $usuario_id      = $_POST['usuario_id'];


                $query_insert = mysqli_query($conection, 
                "INSERT INTO comprobantes(paciente_id,estudio_id,sesion_id,monto,descuento,metodo_pago_id,forma_pago_id,porcentaje,usuario)
                VALUES('$paciente_id','$estudio_id','$sesion_id','$monto','$descuento','$metodo_pago_id','$forma_pago_id','$porcentaje','$usuario_id')");

                if ($query_insert) {
                
                    header("Location:../Templates/comprobantes.php");

                } else {

                    echo $alert = '<p class = "msg_error">Ocurrio un Error</p>';
                }
            
        }
    }
}