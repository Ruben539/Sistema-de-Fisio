<?php

$alert = '';

session_start();

if (!empty($_SESSION['active'])) {

  header('Location: Templates/salir.php');
}else{

  if (!empty($_POST)) {


    if (empty($_POST['usuario']) || empty($_POST['password'])){
      $alert= '<div class= "alert alert-danger"><i class="fas fa-exclamation-triangle"></i><b> Rellene todos los Campos</b></div>';
    }else{

      require_once("Models/conexion.php");
      
      

      $user =  mysqli_real_escape_string($conection,$_POST['usuario']);
      $pass = md5(mysqli_real_escape_string($conection,$_POST['password']));

      if (preg_match('/^[a-zA-ZñÑ]+$/',$_POST['usuario']) &&
        preg_match('/^[0-9a-zA-Z]+$/',$_POST['password'])) {



        $query = mysqli_query($conection,"SELECT u.id,u.nombre,u.correo,u.usuario,u.pass,u.rol FROM usuario u WHERE u.usuario = '$user'
          AND u.pass = '$pass' AND u.estado = 1");

      mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
      $resultado = mysqli_num_rows($query);


      if ($resultado > 0) {
        $data = mysqli_fetch_array($query);

        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['id'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['correo'] = $data['correo'];
        $_SESSION['user'] = $data['usuario'];
        $_SESSION['rol'] = $data['rol'];
        $_SESSION['puesto'] = $data['puesto'];
        


        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
         header('Location: Templates/dashboard.php');


       }
    }else{

      $alert= '<div class= "alert alert-danger"><i class="fas fa-exclamation-triangle"></i><b> El Usuario y/o la Contraseña son Incorrectas</b></div>';

      session_destroy();
    }
  }
}
}
}


?>