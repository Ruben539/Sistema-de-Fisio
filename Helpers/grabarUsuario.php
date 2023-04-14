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
            empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['password'])
            || empty($_POST['rol'])
        ) {

            $alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
        } else {


            $cedula   = $_POST['cedula'];
            $nombre   = $_POST['nombre'];
            $correo   = $_POST['correo'];
            $usuario  = $_POST['usuario'];
            $pass     = md5($_POST['password']);
            $rol      = $_POST['rol'];
            $puesto   = $_POST['puesto'];

            $query = mysqli_query($conection, "SELECT * FROM usuario
             WHERE cedula = '$cedula' OR correo = '$correo'  OR usuario = '$usuario'");

            $resultado = mysqli_fetch_array($query);

            if ($resultado > 0) {
                $alert = '<p class = "msg_error">La cedula , el correo o el telefono ya existen</p>';
            } else {

                $query_insert = mysqli_query($conection, "INSERT INTO usuario(cedula,nombre,correo,usuario,pass,rol,puesto)
                VALUES('$cedula','$nombre','$correo','$usuario','$pass','$rol','$puesto')");

                if ($query_insert) {
                    //    if ($nombrefoto != '') {
                    //         move_uploaded_file($url_temp, $scr);
                    //     }

                    echo $alert = '<p class = "msg_success">Grabado con exito</p>';
                } else {

                    echo $alert = '<p class = "msg_error">Ocurrio un Error</p>';
                }
            }
        }
    }
}
