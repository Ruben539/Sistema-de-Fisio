<?php

session_start();
require_once("../Models/conexion.php");


$anio = date_create($_REQUEST['fecha_desde']);
$fecha = date_format($anio, 'm-Y');

$fecha_desde = date_create($_REQUEST['fecha_desde']);
$fecha_hasta = date_create($_REQUEST['fecha_hasta']);

$desde = date_format($fecha_desde, 'Y-m-d 00:00:00');
$hasta  = date_format($fecha_hasta, 'Y-m-d 23:00:00');

$hoy = date('Y-m-d');

//echo $fecha;
//exit();

if (empty($desde) && empty($hasta)) {
    $sql = mysqli_query($conection, "SELECT c.id,c.porcentaje,c.created_at,c.estatus,u.nombre,u.cedula,e.descripcion as estudio,c.monto,c.descuento,mp.descripcion as metodo, fp.descripcion AS forma,s.descripcion as sesion
    FROM comprobantes c JOIN usuario u on u.id = c.paciente_id
    JOIN estudios e ON e.id = c.estudio_id
    JOIN metodo_pagos mp ON mp.id = c.metodo_pago_id
    JOIN sesiones s ON s.id = c.sesion_id
    JOIN usuario us ON us.id = c.usuario
    INNER JOIN forma_pagos fp ON fp.id = c.forma_pago_id
    where c.created_at LIKE '%".$hoy."%' AND c.estatus = 1");
} else {

    $sql = mysqli_query($conection, "SELECT c.id,c.porcentaje,c.created_at,c.estatus,u.nombre,u.cedula,e.descripcion as estudio,c.monto,c.descuento,mp.descripcion as metodo, fp.descripcion AS forma,s.descripcion as sesion
    FROM comprobantes c JOIN usuario u on u.id = c.paciente_id
    JOIN estudios e ON e.id = c.estudio_id
    JOIN metodo_pagos mp ON mp.id = c.metodo_pago_id
    JOIN sesiones s ON s.id = c.sesion_id
    JOIN usuario us ON us.id = c.usuario
    INNER JOIN forma_pagos fp ON fp.id = c.forma_pago_id
    where c.created_at BETWEEN '".$desde."' AND '".$hasta."' and c.estatus = 1");
}






$resultado = mysqli_num_rows($sql);


echo ' 
<table id="tablaComprobante" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
<thead>
      <tr class="text-center">      
        <th>Nombre</th>
        <th>Servicio Realizado</th>
        <th>Tipo de Sesión</th>
        <th>Costo</th>
        <th>Descuento</th>
        <th>Metodo de Pago</th>                                
        <th>Forma de Pago</th>                                
        <th>Diferencia POST</th>                                
        <th>Usuario</th>                                
        <th>Fecha Realizada</th>                                
        <th>PDF</th>                                
      </tr>
    </thead>
    <tbody class="text-center">';
$monto = 0;

while ($data = mysqli_fetch_array($sql)) {
    $monto += $data['monto'];
    $descuento = $data['descuento'];
    echo '<tr>
             <td>' . $data['nombre'] .'</td>
             <td>' . $data['estudio'] . '</td>
             <td>' . $data['sesion'] . '</td>
             <td>' . $data['monto'] . '</td>
             <td>' . $data['descuento'] . '</td>
             <td>' . $data['metodo'] . '</td>
             <td>' . $data['forma'] . '</td>
             <td>' . $data['porcentaje'] . '</td>
             <td>' . $data['usuario'] . '</td>
             <td>' . $data['created_at'] . '</td>
             <td>
                <a href="../Reports/recibo.php?id=' . $data['id'] . ' " class="btn btn-outline-danger" target="_blank"><i class="fa fa-file-pdf-o"></i></a></td>
             </td>

        </tr>';
}
echo
'</tbody>
  <tfoot>
    <tr>
      <td><b>Total A Rendir : </b></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="text-center alert alert-success">' . number_format($monto - $descuento, 0, '.', '.') . '.<b>GS</b></td>
      
      
    </tr>
  </tfoot>
   </table>';
?>

<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        tablaHerreria = $("#tablaComprobante").DataTable({
            "columnDefs": [{
                "target": 1,
                "data": null
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
                    "sFirst": "<<",
                    "sLast": ">>",
                    "sNext": ">",
                    "sPrevious": "<"
                },
                "sProcessing": "Procesando...",
            }
        });



    });
</script>