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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Facturación</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Registrar Comprobante</h6>
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
                  <h5 class="text-white text-capitalize ps-3">Facturación</h5>
                </div>
              </div>
              <form role="form" method="POST" action="">
                <div class="card-body">
                    <div class="form-check form-check-info text-start ps-0">
                    
                    </div>

                    <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Ingrese la cedula del Paciente</label>
                    <input type="number" class="form-control" name="cedula" id="cedula">
                    </div>

                    <div class="input-group input-group-outline mb-3">
                    <button type="text"  class="btn btn-outline-primary">Comenzar</button>
                    </div>

                </div>
              </form>
           
            <?php 
            require_once('../Models/conexion.php');
if(!empty($_POST))
{

        // resaltamos el resultado
        function resaltar_frase($string, $frase, $taga = '<b>', $tagb = '</b>'){
            return ($string !== '' && $frase !== '')
            ? preg_replace('/('.preg_quote($frase, '/').')/i'.('true' ? 'u' : ''), $taga.'\\1'.$tagb, $string)
            : $string;
             }
    
  
      $aKeyword = explode(" ", $_POST['cedula']);
      $filtro = "WHERE cedula LIKE LOWER('%".$aKeyword[0]."%'))";
      $query ="SELECT u.id,u.cedula,u.nombre,u.fecha_nac FROM usuario u WHERE cedula LIKE LOWER('%".$aKeyword[0]."%') ";
  

     for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " OR cedula LIKE '%" . $aKeyword[$i] . "%' ";
        }
      }
     
     $result = $conection->query($query);
     $numero = mysqli_num_rows($result);
     if (!isset($_POST['cedula'])){
     echo "Has buscado la palabra:<b> ". $_POST['cedula']."</b>";
     }

     if( mysqli_num_rows($result) > 0 AND $_POST['cedula'] != '') {
        $row_count=0;
        echo "<div class = 'col-12'>";
        echo "<br>Resultados encontrados:<b> ".$numero."</b>";
        echo "<br><br><table class='table table-striped'>";
        While($row = $result->fetch_assoc()) {   
            $row_count++;   
            echo "<tr><td>".$row_count." </td><td>". resaltar_frase($row['cedula'] ,$_POST['cedula']) . "</td><td>". resaltar_frase($row['nombre'] ,$_POST['cedula']) . "</td>".
             "<td>"." </td><td>". resaltar_frase($row['fecha_nac'] ,$_POST['cedula']) . "</td><td>". '<a href="registro.php?id='. $row['id'].' " class="btn btn-outline-primary" ><i class="fa fa-user-edit"></i> Cargar Orden</a>' .  "</td></tr>";
        }
        echo "</table>";
        echo "</div>";
	
    }else {
        if($numero == 0) {
          echo "<div class = 'col-12'>";
          echo '<div class="btn btn-outline-primary btn-lg w-100 mt-4 mb-0">';
          echo ' <p >'; 
          echo 'No hay ningún nro de cedula con ese valor.';

          echo '</p>';
          echo '</div>';

            echo '<div class="input-group input-group-outline mb-3">';
            echo '<a href="../View/agregarCliente.php" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" >Registrar Paciente <i class="material-icons opacity-10">receipt_long</i></a>';
            echo '</div>';
        }else{
            $row_count=0;
            echo "<br>Resultados encontrados:<b> ".$numero."</b>";
            echo "<br><br><table class='table table-striped'>";
            While($row = $result->fetch_assoc()) {   
                $row_count++;   
                echo "<tr><td>".$row_count." </td><td>". resaltar_frase($row['nombre'] ,$_POST['cedula']) . "</td><td>". resaltar_frase($row['Apellido'] ,$_POST['cedula']) . "</td></tr>";
            }
            echo "</table>";
            echo "</div>";
        }
      //mostramos todos los resultados

      
	
 
    }
}
?> </div>
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