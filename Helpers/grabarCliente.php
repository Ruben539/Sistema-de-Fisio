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
            empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['fecha_nac']) || empty($_POST['sexo'])
        ) {

            $alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
        } else {


            $cedula    = $_POST['cedula'];
            $nombre    = $_POST['nombre'];
            $correo    = $_POST['correo'];
            $fecha_nac = $_POST['fecha_nac'];
            $telefono  = $_POST['telefono'];
            $sexo      = $_POST['sexo'];
            $puesto    = $_POST['puesto'];
            $rol       = $_POST['rol'];

            $query = mysqli_query($conection, "SELECT * FROM usuario WHERE cedula = '$cedula' ");

            $resultado = mysqli_fetch_array($query);

            if ($resultado > 0) {
                $alert = '<p class = "msg_error">La cedula ya existe</p>';
            } else {

                $query_insert = mysqli_query($conection, "INSERT INTO usuario(cedula,nombre,correo,fecha_nac,telefono,sexo,puesto,rol)
                VALUES('$cedula','$nombre','$correo','$fecha_nac','$telefono','$sexo','$puesto','$rol')");

                if ($query_insert) {
                    header('Location: ../Templates/registro.php');
                } else {

                    $alert = '<p class = "msg_error">Ocurrio un Error</p>';
                }
            }
        }
    }
}
