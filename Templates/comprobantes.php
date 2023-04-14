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
          <h6 class="font-weight-bolder mb-0">Comprobantes</h6>
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
                <h5 class="text-white text-capitalize ps-3">Informes de Comprobantes</h5>
              </div>
            </div>
            <div class="card-body">
              <div class="form-check form-check-info text-start ps-0">
                <form method="POST" id='formComprobantes' name='formComprobantes'>
                  <label class="form-label" for="flexCheckDefault">
                    Desde
                  </label>&nbsp;&nbsp;&nbsp;
                  <input class="form-input" type="date" name="fecha_desde" id="fecha_desde" style="width: 300px; 
                  height:35px; border: 1px solid green;
                  border-radius:10px; padding:0 10px; margin:auto;">&nbsp;&nbsp;&nbsp;


                  <label class="form-label" for="flexCheckDefault">
                    Hasta
                  </label>&nbsp;&nbsp;&nbsp;
                  <input class="form-input" type="date" name="fecha_hasta" id="fecha_hasta" style="width:300px; 
                  height:35px; border: 1px solid green;
                  border-radius:10px; padding:0 10px; margin:auto;">&nbsp;&nbsp;&nbsp;

                  <button class="btn btn-outline-primary" style="width:100px; 
                  height:35px; border: 1px solid green;color:green;
                  border-radius:10px; padding:0 10px; margin:auto;" type="submit">Buscar <i class="fa fa-fw fa-lg fa-search"></i></button>
                </form>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="tile">
                    <div class="table-responsive" id="tablaResultado">



                    </div>
                  </div>
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
  <script type="text/javascript">
  $('#formComprobantes').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
      type: "POST",
      url: '../Data/BuscarComprobante.php',
      data: form.serialize(),
      success: function(data) {
        $('#tablaResultado').html('');
        $('#tablaResultado').append(data);
      }

    });

  });
</script>