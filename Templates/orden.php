<?php

include_once('../includes/admin_header.php');
require_once('../Models/conexion.php');
session_start();
?>

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
                        
                        $paciente_id     = $_POST['paciente_id'];
                        $estudio_id      = $_POST['estudio_id'];
                        $sesion          = $_POST['sesion_id'];
                        $usuario_id      = $_POST['usuario_id'];
                        $metodo_pago_id  = $_POST['metodo_pago_id'];
                        $forma_pago_id   = $_POST['forma_pago_id'];
                        $descuento       = $_POST['descuento'];
                        $usuario         = $_SESSION['idUser'];

                        if (!empty($paciente_id)) {

                            $sql = mysqli_query($conection, "SELECT * FROM usuario  WHERE id = $paciente_id AND estado = 1 ");

                            //mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


                            $resultado = mysqli_num_rows($sql);

                            if ($resultado == 0) {
                                header("location: ../Templates/facturacion.php");
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
                            echo 'Error';
                        }

                        if (!empty($usuario_id)) {

                            $sql = mysqli_query($conection, "SELECT * FROM usuario  WHERE id = $usuario_id AND estado = 1 ");

                            //mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


                            $resultado = mysqli_num_rows($sql);

                            if ($resultado == 0) {
                                header("location: ../Templates/facturacion.php");
                            } else {
                                $option = '';
                                while ($data = mysqli_fetch_array($sql)) {

                                    $iduser     = $data['id'];
                                    $cedula     = $data['cedula'];
                                    $atendedor  = $data['nombre'];
                                    $telefono   = $data['telefono'];
                                    $fecha_nac  = $data['fecha_nac'];
                                }
                            }
                        } else {
                            echo 'Error';
                        }

                        if (!empty($forma_pago_id)) {

                            $sql = mysqli_query($conection, "SELECT * FROM forma_pagos  WHERE id = $forma_pago_id AND estado = 0 ");

                            //mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


                            $resultado = mysqli_num_rows($sql);

                            if ($resultado == 0) {
                                header("location: ../Templates/facturacion.php");
                            } else {
                                $option = '';
                                while ($data = mysqli_fetch_array($sql)) {

                                    $id           = $data['id'];
                                    $descripcion  = $data['descripcion'];
                                    
                                }
                            }
                        } else {
                            echo 'Error';
                        }


                        ?>




                        <div class="card-body">
                            <div class="form-check form-check-info text-start ps-0">
                                <div class="card-body pt-4 p-3">
                                    <ul class="list-group">
                                        <h1 class="mb-3 text-center">Datos del Comprobante </h1>
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="d-flex flex-column">
                                                <h1 class="mb-3 text-sm">Nombre del Cliente : <?= $nombre; ?></h1>
                                                <h3 class="mb-2 text-xs">Nro de Cedula: <span class="text-dark font-weight-bold ms-sm-2"><?= $cedula; ?></span></h3>
                                                <h3 class="mb-2 text-xs">Nro de Telefono: <span class="text-dark font-weight-bold ms-sm-2"><?= $telefono; ?></span></h3>
                                                <h3 class="mb-2 text-xs">Profesional Tratante: <span class="text-dark font-weight-bold ms-sm-2"><?= $atendedor; ?></span></h3>
                                                <h3 class="mb-2 text-xs">Forma de Pago: <span class="text-dark font-weight-bold ms-sm-2"><?= $descripcion; ?></span></h3>
                                            </div>
                                        </li>
                                        <hr />
                                        <h3 class="text-center">Servicios Realizados</h3>
                                        <form action="../Controllers/facturaController.php" method="post">
                                             
                                            <table class='table'>
                                                <?php if (!empty($estudio_id)) {
                                                    $total = 0;
            
                                                    for($i=0;$i<count($estudio_id);$i++){ 

                                                    $sql = mysqli_query($conection, "SELECT e.id,e.descripcion, e.costo FROM estudios e  WHERE e.id = $estudio_id[$i] AND estado = 1 ");

                                                    //mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


                                                    $resultado = mysqli_num_rows($sql);

                                                    if ($resultado == 0) {
                                                        header("location: ../Templates/usuarios.php");
                                                    } else {
                                                        
                                                        while ($data = mysqli_fetch_array($sql)) {
                                                            
                                                            $idEstudio   = $data['id'];
                                                            $descripcion = $data['descripcion'];
                                                            $costo       = $data['costo']; 
                                                            $total       += (int)$data['costo'];

                                                            ?>
                                                            <tbody>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><?= $descripcion; ?></td>
                                                                    <td></td>
                                                                    <td><?=  number_format($costo, 0, '.','.'); ?> GS</td>
                                                                    

                                                                </tr>
                                                    <?php          }
                                                    }
                                                    }
                                                } else {
                                                    echo 'Error';
                                                } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td>Total a Cobrar: </td>
                                                            <td></td>
                                                            <td></td>
                                                            <?php if($forma_pago_id == 1){
                                                                $credito = ($total - $descuento) * 0.05;
                                                            ?>                                                               
                                                            <td><?= number_format($total - $credito  , 0, '.','.') ; ?> GS</td>
                                                           
                                                           <?php }elseif ($forma_pago_id == 2) {

                                                                 $debito = ($total - $descuento) * 0.03;
                                                            ?>
                                                            <td><?= number_format($total - $debito  , 0, '.','.') ; ?> GS</td>
                                                            
                                                            <?php }else{?>
                                                                <td><?= number_format($total   , 0, '.','.') ; ?> GS</td>
                                                            <?php }?>
                                                            
                                                        </tr>
                                                    </tfoot>
                                            </table>
                                          
                                            <input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo $id; ?>">
                                            <input type="hidden" name="estudio_id" id="estudio_id" value="<?php echo $idEstudio; ?>">
                                            <input type="hidden" name="sesion_id" id="sesion_id" value="<?php echo $sesion; ?>">
                                            <input type="hidden" name="monto" id="monto" value="<?php echo $costo; ?>">
                                            <input type="hidden" name="descuento" id="descuento" value="<?php echo $descuento; ?>">
                                            <input type="hidden" name="metodo_pago_id" id="metodo_pago_id" value="<?php echo $metodo_pago_id; ?>">
                                            <input type="hidden" name="forma_pago_id" id="forma_pago_id" value="<?php echo $forma_pago_id; ?>">
                                            <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $usuario; ?>">
                                            <?php if($forma_pago_id == 1){?>
                                                <input type="hidden" name="porcentaje" id="porcentaje" value="<?php echo $credito; ?>">
                                            <?php }elseif($forma_pago_id == 2){?>
                                                <input type="hidden" name="porcentaje" id="porcentaje" value="<?php echo $debito; ?>">
                                            <?php }else{?>
                                                <input type="hidden" name="porcentaje" id="porcentaje" value="<?php echo $total; ?>">
                                            <?php }?>
                                            <div class="input-group input-group-outline mb-3">
                                                <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Registrar</button>
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
    <?php include_once('../includes/admin_footer.php') ?>