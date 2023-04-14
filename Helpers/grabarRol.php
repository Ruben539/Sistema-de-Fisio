<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
    if (empty($_SESSION['active'])) {
    header('location: ../Templates/salir.php');
}
require_once("../Models/conexion.php");
$alert = '';

//print_r($_POST);
//print_r($_FILES);
//exit;
if (!empty($_POST)) {
    if (empty($_POST['descripcion']) ) {

        $alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

        }else{

            
            $descripcion   = $_POST['descripcion'];
            

       
            $query_insert = mysqli_query($conection,"INSERT INTO roles(descripcion)
                VALUES('$descripcion')");

            if ($query_insert ) {
            //    if ($nombrefoto != '') {
            //         move_uploaded_file($url_temp, $scr);
            //     }
                
            echo '<p class = "msg_success">Grabado con exito</p>';

            }else{
              
              echo '<p class = "msg_error">Ocurrio un Error</p>';
         }

       }
    }
}

?>