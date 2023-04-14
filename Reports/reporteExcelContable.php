<?php


session_start();
require_once('../vendor/autoload.php');
require_once("../Models/conexion.php");

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};


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
    $sql = "SELECT c.id,u.nombre,e.descripcion as estudio,c.monto,c.descuento,mp.descripcion as metodo,fp.descripcion as forma,c.porcentaje,us.nombre as ususuario,c.created_at FROM comprobantes c INNER JOIN usuario u ON u.id = c.paciente_id 
  INNER JOIN estudios e ON e.id = c.estudio_id INNER JOIN metodo_pagos mp ON mp.id = c.metodo_pago_id
  INNER JOIN forma_pagos fp ON fp.id = c.forma_pago_id INNER JOIN usuario us ON us.id = c.usuario
  WHERE c.created_at LIKE '".$hoy."'";
} else {

    $sql = "SELECT c.id,u.nombre,e.descripcion as estudio,c.monto,c.descuento,mp.descripcion as metodo,fp.descripcion as forma,c.porcentaje,us.nombre as usuario,c.created_at FROM comprobantes c INNER JOIN usuario u ON u.id = c.paciente_id 
  INNER JOIN estudios e ON e.id = c.estudio_id INNER JOIN metodo_pagos mp ON mp.id = c.metodo_pago_id
  INNER JOIN forma_pagos fp ON fp.id = c.forma_pago_id INNER JOIN usuario us ON us.id = c.usuario
  WHERE c.created_at BETWEEN '".$desde."' AND '".$hasta."';";
}

$resultado = mysqli_query($conection,$sql);

$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle('Reporte de Contabilidad');

$hojaActiva->setCellValue('A1','Fecha');
$hojaActiva->setCellValue('B1','Nombre y Apellido');
$hojaActiva->setCellValue('C1','Servicio Realizado');
$hojaActiva->setCellValue('D1','Costo');
$hojaActiva->setCellValue('E1','Descuento');
$hojaActiva->setCellValue('F1','Metodo de Pago');
$hojaActiva->setCellValue('G1','Forma de Pago');
$hojaActiva->setCellValue('H1','Diferencia POST');
$hojaActiva->setCellValue('I1','Total a Pagar');

$fila = 2;

while ($rows = $resultado->fetch_assoc()){
    $hojaActiva->setCellValue('A'.$fila,$rows['created_at']);
    $hojaActiva->setCellValue('B'.$fila,$rows['nombre']);
    $hojaActiva->setCellValue('C'.$fila,$rows['estudio']);
    $hojaActiva->setCellValue('D'.$fila,number_format((int)$rows['monto'], 1, '.', '.'));
    $hojaActiva->setCellValue('E'.$fila,number_format($rows['descuento'], 1, '.', '.'));
    $hojaActiva->setCellValue('F'.$fila,$rows['metodo']);
    $hojaActiva->setCellValue('G'.$fila,$rows['forma']);
    $hojaActiva->setCellValue('H'.$fila,number_format((int)$rows['porcentaje'], 1,'.','.'));
    $hojaActiva->setCellValue('I'.$fila,number_format((int)$rows['monto'] - (int)$rows['porcentaje'], 1,'.','.') );
    $fila++;
}


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Excel-Contable.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;