<?php 

include_once('../includes/admin_header.php');
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
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
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Pacientes del Dia</p>
                <h4 class="mb-0" id="idPacientesDiarios">0</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
            <p class="mb-0"><span class="text-info text-sm font-weight-bolder">Cantidad de Pacientes del dia</span></p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">groups</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Pacientes del Mes</p>
                <h4 class="mb-0" id="idPacientesMensuales">0</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Total de Pacientes del mes</span></p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">payments</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Ingreso del Dia</p>
                <h4 class="mb-0" id="idMontoDiario">0</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-info text-sm font-weight-bolder">Total ingresado en el dia</span></p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">payments</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Monto Mensual</p>
                <h4 class="mb-0" id="idMontoMensual">0</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Rendicion Total de mes</span></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
         
        </div>
      
       
      </div>
      <div class="row mb-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0 text-center">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nro</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre del Paciente</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cedula</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estudio</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    require_once("../Models/conexion.php");
                    $hoy = date('Y-m-d');
                   // echo $hoy;
                    //exit();

                  
                          $sql = mysqli_query($conection, "SELECT c.id,u.nombre,u.cedula,e.descripcion as estudio,c.monto,c.descuento,mp.descripcion as metodo,fp.descripcion as forma,
                          c.porcentaje,us.nombre as ususuario,c.created_at,s.descripcion as sesion,c.estatus FROM comprobantes c INNER JOIN usuario u ON u.id = c.paciente_id 
                        INNER JOIN estudios e ON e.id = c.estudio_id INNER JOIN metodo_pagos mp ON mp.id = c.metodo_pago_id
                        INNER JOIN sesiones s ON s.id = c.sesion_id INNER JOIN forma_pagos fp ON fp.id = c.forma_pago_id INNER JOIN usuario us ON us.id = c.usuario
                        WHERE c.created_at LIKE '%".$hoy."%' AND c.estatus = 1");

                        $resultado = mysqli_num_rows($sql);
                        $monto = 0;
                        $cont = 0;

                        if($resultado > 0){ 
                          while ($data = mysqli_fetch_array($sql)){ 
                            $monto += $data['monto'];
                            $cont++;
                    ?>
                    <tr>
                      <td><?php echo $cont; ?></td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/fisio1.jpg" class="avatar avatar-sm me-3" alt="xd">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $data['nombre'];?></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                      <span class="text-xs font-weight-bold"><?php echo $data['cedula'];?></span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"><?php echo $data['estudio'];?></span>
                      </td>
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <?php if($data['estatus'] == 1){?>
                                <h5 class="text-success">Atendido</h5>
                                <?php }?>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php }
                    }?>
                  </tbody>
                </table>
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