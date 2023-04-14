<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
    if (empty($_SESSION['active'])) {
    header('location: salir.php');
}

}else{
  header('location: salir.php');  
}

require_once('../Models/conexion.php');
require_once('../includes/admin_header.php');
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
          <h6 class="font-weight-bolder mb-0">Usuarios</h6>
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
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Servicios del Sistema
                  
                <a class="btn btn-outline-danger" href="../View/agregarServicio.php">
                  <i class="fa fa-plus" aria-hidden="true"></i> Nuevo</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 " id="tabla_Servicios">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nombre</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Costo</th>
                      <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
                      <th class="text-secondary opacity-7">Editar</th>
                      <th class="text-secondary opacity-7">Eliminar</th>
                      <?php }?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                        $sql = mysqli_query($conection," SELECT s.id,s.descripcion,s.costo 
                        FROM estudios s  where  s.estado = 1 ORDER BY  s.id DESC");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $data['id'];?></h6>
                            
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <p class="text-center font-weight-bold mb-0"><?php echo $data['descripcion'];?></p>
                      </td>

                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success"><?php echo $data['costo'];?></span>
                      </td>
                      <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
                          <td>
                             <a href="../View/modificarEstudio.php?id=<?php echo $data['id']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-edit"></i></a>
                          </td>
                      <?php } ?>
                      <?php if($_SESSION['rol'] == 1 ){ ?>
                          <td>
                            <button onclick="EliminarEstudio('<?php echo $data['id']; ?>')"
                            class="btn btn-outline-danger" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-user-times"></i></button>
                          </td>
                    <?php } ?>
                    <?php if($_SESSION['rol'] == 2 ){ ?>
                      <td>
                        <a href="#" onclick="permisoAuto()" class="btn btn-outline-danger" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-user-times"></i></a>
                      </td>
                    <?php } ?> 

                    </tr>
                    <?php }
                } ?>
                  </tbody>
                </table>
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
<script src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script src="../js/estudios.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
   
        $('#btnEditarPass').click(function() {
            /* Act on the event */
            EliminarEstudio();
        });
    });
</script>
<!--Srcip para vaildar el boton de Usuarios-->
<script>
  function permisoAuto(){
Swal.fire({
  /*toast: true,*/
  position: 'center',
  title: 'Mensaje del Sistema !',
  text: 'No posee el permiso para eliminar un Estudio',
  footer:'Contactar con el administrador del sistema!',
  imageUrl: '../assets/img/fisio2.png',
  imageWidth: 200,
  imageHeight: 200,
  imageAlt: 'Custom image',
  showConfirmButton: false,
  timer: 5000, 

})
}
</script>
<!------------------------------------------------------------------------------>
<script type="text/javascript">
    $(document).ready(function(){
    tablaServicios = $("#tabla_Servicios").DataTable({
       "columnDefs":[{
        "target": 1,
        "data":null
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "1",
                "sLast":">>",
                "sNext":">",
                "sPrevious": "<"
             },
             "sProcessing":"Procesando...",
        }
    });

      
    
});
</script>

