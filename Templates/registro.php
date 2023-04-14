<?php

include_once('../includes/admin_header.php');
require_once('../Models/conexion.php');
?>
<link rel="stylesheet" href="../node_modules/chosen-js/chosen.css" type="text/css" />
    <script src="../node_modules/chosen-js/chosen.jquery.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../node_modules/chosen-js/chosen.jquery.js"></script>
    <script>
        $(document).ready(function() {
            $(".chosen").chosen();
        });
    </script>
<body class="g-sidenav-show  bg-gray-200">
    <?php include_once('../includes/admin_nav.php'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Comprobante</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Cargar Comprobante</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group input-group-outline">

                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">

                        <li class="nav-item d-flex align-items-center">
                            <a href="../Templates/salir.php" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Cerrar Sesión</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="row min-vh-80">
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h5 class="text-white text-capitalize ps-3 text-center">Registro de Comprobante</h5>
                            </div>
                        </div>
                        <?php
                     
                        if (empty($_REQUEST['id'])) {

                            $sql = mysqli_query($conection, "SELECT * FROM usuario  WHERE  estado = 1 order by id desc limit 1");

                            //mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


                            $resultado = mysqli_num_rows($sql);

                            if ($resultado == 0) {
                                header("location: ../Templates/usuarios.php");
                            } else {
                                $option = '';
                                while ($data = mysqli_fetch_array($sql)) {

                                    $iduser     = $data['id'];
                                    $cedula     = $data['cedula'];
                                    $nombre     = $data['nombre'];
                                    $telefono   = $data['telefono'];
                                    $fecha_nac  = $data['fecha_nac'];
                                }
                            }
                        } else {

                            $sql = mysqli_query($conection, "SELECT * FROM usuario  WHERE id = '".$_REQUEST['id']."' AND estado = 1 ");

                            //mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


                            $resultado = mysqli_num_rows($sql);

                            if ($resultado == 0) {
                                header("location: ../Templates/usuarios.php");
                            } else {
                                $option = '';
                                while ($data = mysqli_fetch_array($sql)) {

                                    $id         = $data['id'];
                                    $cedula     = $data['cedula'];
                                    $nombre     = $data['nombre'];
                                    $telefono   = $data['telefono'];
                                    $fecha_nac  = $data['fecha_nac'];
                                }
                            }
                        }
                        ?>
                        <div class="card-body">
                            <div class="form-check form-check-info text-start ps-0">
                                <div class="card-body pt-4 p-3">
                                    <ul class="list-group">
                                    <h1 class="mb-3 text-center">Datos del Cliente </h1>
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="d-flex flex-column">
                                                <h1 class="mb-3 text-sm">Nombre del Cliente : <?= $nombre; ?></h1>
                                                <h3 class="mb-2 text-xs">Nro de Cedula: <span class="text-dark font-weight-bold ms-sm-2"><?= $cedula; ?></span></h3>
                                                <h3 class="mb-2 text-xs">Nro de Telefono: <span class="text-dark font-weight-bold ms-sm-2"><?= $telefono; ?></span></h3>
                                                <h3 class="mb-2 text-xs">Fecha de Nacimiento: <span class="text-dark font-weight-bold ms-sm-2"><?= $fecha_nac; ?></span></h3>
                                            </div>
                                        </li>
                                        <hr />
                                        <form action="orden.php" method="post">
                                            <input type="hidden" name="paciente_id" id="paciente_id" value="<?= $id; ?>" >
                                            <label class="form-label">Servicio a Realizar :</label>
                                            <div class="input-group input-group-outline mb-">

                                                <?php
                                                include "../Models/conexion.php";

                                                $query_estudio = mysqli_query($conection, "SELECT * FROM estudios where  estado = 1");

                                                mysqli_close($conection); //con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
                                                $resultado = mysqli_num_rows($query_estudio);

                                                ?>
                                               <select name="estudio_id[]" id="estudio_id[]" class="chosen form-control" data-placeholder="Elige uno o varios estudios" multiple>
                                                    <?php

                                                    if ($resultado > 0) {
                                                        while ($rol = mysqli_fetch_array($query_estudio)) {

                                                    ?>
                                                            <option value="<?php echo $rol["id"]; ?>"><?php echo
                                                                $rol["descripcion"] ?></option>

                                                    <?php


                                                        }
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <hr />
                                            <label class="form-label">Profesional Atendedor :</label>
                                            <div class="input-group input-group-outline mb-1">

                                                <?php
                                                include "../Models/conexion.php";

                                                $query_fisio = mysqli_query($conection, "SELECT * FROM usuario where rol =  2 OR rol = 3 AND estado = 1");

                                                mysqli_close($conection); //con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
                                                $resultado = mysqli_num_rows($query_fisio);

                                                ?>
                                                <select name="usuario_id" id="usuario_id" class="form-control">
                                                    <?php

                                                    if ($resultado > 0) {
                                                        while ($rol = mysqli_fetch_array($query_fisio)) {

                                                    ?>
                                                            <option value="<?php echo $rol["id"]; ?>"><?php echo
                                                                $rol["nombre"] ?></option>

                                                    <?php


                                                        }
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <hr />
                                            <label class="form-label">Tipo de Sesión a Realizar :</label>
                                            <div class="input-group input-group-outline mb-1">

                                                <?php
                                                include "../Models/conexion.php";

                                                $query_fisio = mysqli_query($conection, "SELECT * FROM sesiones where  estado = 1");

                                                mysqli_close($conection); //con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
                                                $resultado = mysqli_num_rows($query_fisio);

                                                ?>
                                                <select name="sesion_id" id="sesion_id" class="form-control">
                                                    <?php

                                                    if ($resultado > 0) {
                                                        while ($rol = mysqli_fetch_array($query_fisio)) {

                                                    ?>
                                                            <option value="<?php echo $rol["id"]; ?>"><?php echo
                                                                $rol["descripcion"] ?></option>

                                                    <?php


                                                        }
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <hr />
                                            <label class="form-label">Metodo de Pago :</label>
                                            <div class="input-group input-group-outline mb-1">

                                                <?php
                                                include "../Models/conexion.php";

                                                $query_metodo = mysqli_query($conection, "SELECT * FROM metodo_pagos where  estado = 0");

                                                mysqli_close($conection); //con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
                                                $resultado = mysqli_num_rows($query_metodo);

                                                ?>
                                                <select name="metodo_pago_id" id="metodo_pago_id" class="form-control">
                                                    <?php

                                                    if ($resultado > 0) {
                                                        while ($metodo = mysqli_fetch_array($query_metodo)) {

                                                    ?>
                                                            <option value="<?php echo $metodo["id"]; ?>"><?php echo
                                                             $metodo["descripcion"] ?></option>
                                                    <?php


                                                        }
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                            <hr />
                                            <label class="form-label">Forma de Pago:</label>
                                            <div class="input-group input-group-outline mb-1">

                                                <?php
                                                include "../Models/conexion.php";

                                                $query_pago = mysqli_query($conection, "SELECT * FROM forma_pagos where  estado = 0");

                                                mysqli_close($conection); //con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
                                                $resultado = mysqli_num_rows($query_pago);

                                                ?>
                                                <select name="forma_pago_id" id="forma_pago_id" class="form-control">
                                                    <?php

                                                    if ($resultado > 0) {
                                                        while ($rol = mysqli_fetch_array($query_pago)) {

                                                    ?>
                                                            <option value="<?php echo $rol["id"]; ?>"><?php echo
                                                                $rol["descripcion"] ?></option>

                                                    <?php


                                                        }
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                            <hr />

                                            <div class="input-group input-group-outline mb-3">
                                                <label class="form-label">Ingrese el Descuento :</label>
                                                <input type="number" class="form-control" name="descuento" id="descuento">
                                            </div>

                                            <div class="input-group input-group-outline mb-3">
                                                <label class="form-label">Pago Parcial :</label>
                                                <input type="number" class="form-control" name="descuento" id="descuento">
                                            </div>

                                            <div class="input-group input-group-outline mb-3">
                                                <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Generar Orden <i class="material-icons opacity-10">receipt_long</i></button>
                                            </div>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            Inicio de Diseño <i class="fa fa-heart"></i> en colaboración
                            <a href="#" class="font-weight-bold" target="_blank">RubenFl</a>
                            Website in designe
                        </div>
                    </div>

                </div>
            </div>
        </footer>
        </div>
    </main>
