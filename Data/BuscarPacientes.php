<?php

session_start();
require_once("../Models/conexion.php");


$cedula = $_POST['inputCedula'];
$nombre = $_POST['inptudNombre'];



if ($cedula && empty($nombre)) {
    $sql = mysqli_query($conection, "SELECT c.id,u.nombre,u.cedula as documento,u.fecha_nac,e.descripcion as estudio,c.monto,c.descuento,mp.descripcion as metodo,fp.descripcion as forma,c.porcentaje,us.nombre as usuario,c.created_at,s.descripcion as sesion FROM comprobantes c INNER JOIN usuario u ON u.id = c.paciente_id 
  INNER JOIN estudios e ON e.id = c.estudio_id INNER JOIN metodo_pagos mp ON mp.id = c.metodo_pago_id
  INNER JOIN sesiones s ON s.id = c.sesion_id INNER JOIN forma_pagos fp ON fp.id = c.forma_pago_id INNER JOIN usuario us ON us.id = c.usuario
  WHERE u.cedula LIKE '%".$cedula."%'");
} else {

    $sql = mysqli_query($conection, "SELECT c.id,u.nombre,u.cedula as documento,u.fecha_nac,e.descripcion as estudio,c.monto,c.descuento,mp.descripcion as metodo,fp.descripcion as forma,c.porcentaje,us.nombre as usuario,c.created_at, s.descripcion as sesion FROM comprobantes c INNER JOIN usuario u ON u.id = c.paciente_id 
  INNER JOIN estudios e ON e.id = c.estudio_id INNER JOIN metodo_pagos mp ON mp.id = c.metodo_pago_id
  INNER JOIN sesiones s ON s.id = c.sesion_id INNER JOIN forma_pagos fp ON fp.id = c.forma_pago_id INNER JOIN usuario us ON us.id = c.usuario
  WHERE u.nombre LIKE '%".$nombre."%'");
}


$resultado = mysqli_num_rows($sql);


if($resultado = 0){
    echo '<div class="msg-win">No hay comprobantes disponibles</div>'; 
}




$monto = 0;

while ($data = mysqli_fetch_array($sql)) {
    $monto += $data['monto'];
    $descuento = $data['descuento'];
    $post = $data['porcentaje'];
    echo '
    <div class="col-12 mx-auto">
      <div class="card mt-7">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Paciente: ' . $data['nombre'] .'</h6>
            <p class="mb-0 text-white ps-3">Cedula : 
              <a class="text-white font-weight-bold" target="_blank" href="#"> ' . $data['documento'] .'</a>
            </p>
            <p class="mb-0 text-white ps-3">Fecha de Nacimiento : 
            <a class="text-white font-weight-bold" target="_blank" href="#"> ' . $data['fecha_nac'] .'</a>
            </p>
            <p class="mb-0 text-white ps-3">Metodo de Pago : 
              <a class="text-white font-weight-bold" target="_blank" href="#"> ' . $data['metodo'] .'</a>
            </p>
            <p class="mb-0 text-white ps-3">Forma de Pago :  
            <a class="text-white font-weight-bold" target="_blank" href="#"> ' . $data['forma'] .'</a>
            </p>
          </div>
        </div>
        <div class="card-body">
          <table class = "table">
          <thead class="text-center">
          <tr >      
            
            <th>Servicio Realizado</th>
            <th>Nro de Sesión</th>
            <th>Costo</th>
            <th>Descuento</th>                               
            <th>Diferencia POST</th>                                
            <th>Usuario</th>                                
            <th>Fecha Realizada</th>                                                                
          </tr>
        </thead>
        <tbody class="text-center">
            <tr>

            <td>' . $data['estudio'] . '</td>
            <td>' . $data['sesion'] . '</td>
            <td>' . $data['monto'] . '</td>
            <td>' . $data['descuento'] . '</td>
            <td>' . $data['porcentaje'] . '</td>
            <td>' . $data['usuario'] . '</td>
            <td>' . $data['created_at'] . '</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
            <td>Monto Total :</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center alert alert-success" style="color: #fff;">' . number_format($monto - $descuento - $post, 0, '.', '.') . 'GS</td>
            </tr>
          </tfoot>
          </table>
        </div>
      </div>
    </div>
  ';
}

?>
