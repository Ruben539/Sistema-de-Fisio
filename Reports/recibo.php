<?php 

session_start();

require_once("../Models/conexion.php");




if (empty($_REQUEST['id'])) {
	header('location: ../Templates/dashboard.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT c.id,u.nombre as nombre,u.cedula,u.telefono,u.fecha_nac,e.descripcion as estudio,c.monto,c.descuento,mp.descripcion as metodo,
fp.descripcion as forma,c.porcentaje,us.nombre as usuario,c.created_at as fecha,s.descripcion as sesion FROM comprobantes c INNER JOIN usuario u ON u.id = c.paciente_id 
  INNER JOIN estudios e ON e.id = c.estudio_id INNER JOIN metodo_pagos mp ON mp.id = c.metodo_pago_id
  INNER JOIN sesiones s ON s.id = c.sesion_id INNER JOIN forma_pagos fp ON fp.id = c.forma_pago_id INNER JOIN usuario us ON us.id = c.usuario
  WHERE c.id = $id ");   

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

//echo 'paso el sql';
//exit();


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
     
	header("location: ../Templates/dashboard.php");
}else{
	$cont = 0;
	while ($data = mysqli_fetch_array($sql)) {
		$cont++;
		$id          = $data['id'];
		$cedula      = $data['cedula'];
		$nombre      = $data['nombre'];
		$telefono    = $data['telefono'];
		$fecha_nac   = $data['fecha_nac'];
		$estudio     = $data['estudio'];
		$monto       = $data['monto'];
		$descuento   = $data['descuento'];
		$metodo      = $data['metodo'];
		$forma       = $data['forma'];
		$sesion      = $data['sesion'];
		$fecha       = $data['fecha'];
		
	}
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sistemaFisio/assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sistemaFisio/assets/bootstrap/dist/css/bootstrap.min.css">
  <title>Factura</title>
</head>

<body>

<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
				<div>
					<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sistemaFisio/assets/img/fisio1.jpg" 
                    style="width: 100px;
                    height: 100px;
                    border: 2px solid #fff;
                    border-radius: 50%;"
                    >
				</div>
			</td>
			<td class="info_empresa">
				<h1 style="color: green;">R<span style="color: black; font-size: 25px; font-family: 'Courier New', Courier, monospace;">Fisio</span></h1>
				<h3>Fisioterapia <span style="color: green; font-size: 16px;">&</span> Estetic</h3>
				<p>Dirección: Jose Ocampos Lanzoni 680, Asunción</p>
				<p>Telefono: 021514974</p>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3" style="color:#fff;">Factura</span>
					<p>No. Factura: 001-003-0000001 <strong></strong></p>
					<p>Fecha: <?php echo $fecha; ?></p>
					<p>Timbrado: 123456789</p>
					<p>Inicio Vigencia: 09-06-2023</p>
					<p>Fin Vigencia: 09-06-2024</p>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3" style="color:#fff;">Datos del Cliente</span>
					<table class="datos_cliente">
						<tr>
							<td><label>Ruc : </label><p> <?php echo $cedula; ?></p></td>
							<td><label>Teléfono: </label> <p> <?php echo $telefono; ?></p></td>
						</tr>
						<tr>
							<td><label>Nombre: </label> <p> <?php echo $nombre ?></p></td>
							<td><label>Fecha Nac. : </label> <p> <?php echo $fecha_nac;?></p></td>
							
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="factura_detalle">
			<thead>
				<tr>
					
					<th width="50px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px"> Descuento</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">

			
				<tr>
					<td class="textcenter"><?php echo $cont;?></td>
					<td><?php echo $estudio;?></td>
					<td class="textright"><?php echo number_format($monto , 0,'.','.')?> GS;</td>
					<td class="textright"><?php echo number_format( $descuento, 0,'.','.')?> GS;</td>
				</tr>
			
				
			</tbody>
			<br />
           <tfoot style="border-top: 1px solid black; border-bottom: 1px solid black;">
			<th></th>
			<th></th>
			<th>Total Iva: 5%</th>
			<th>Total: <?php echo number_format($monto - $descuento, 0,'.','.')?> GS</th>
		   </tfoot>
	</table>
	<div>
		<p>Si usted tiene preguntas sobre esta factura, pongase en contacto con nombre, teléfono y Email</p>
		<p class="text-right"><b>Original Cliente</b> </p>
	</div>
	
</div>

<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
				<div>
					<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sistemaFisio/assets/img/fisio1.jpg" 
                    style="width: 100px;
                    height: 100px;
                    border: 2px solid #fff;
                    border-radius: 50%;"
                    >
				</div>
			</td>
			<td class="info_empresa">
			<h1 style="color: green;">R<span style="color: black; font-size: 25px; font-family: 'Courier New', Courier, monospace;">Fisio</span></h1>
				<h3>Fisioterapia <span style="color: green; font-size: 16px;">&</span> Estetic</h3>
				<p>Dirección: Jose Ocampos Lanzoni 680, Asunción</p>
				<p>Telefono: 021514974</p>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3" style="color:#fff;">Factura</span>
					<p>No. Factura: 001-003-0000001 <strong></strong></p>
					<p>Fecha: <?php echo $fecha; ?></p>
					<p>Timbrado: 123456789</p>
					<p>Inicio Vigencia: 09-06-2023</p>
					<p>Fin Vigencia: 09-06-2024</p>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3" style="color:#fff;">Datos del Cliente</span>
					<table class="datos_cliente">
						<tr>
							<td><label>Ruc : </label><p> <?php echo $cedula; ?></p></td>
							<td><label>Teléfono: </label> <p> <?php echo $telefono; ?></p></td>
							
						</tr>
						<tr>
							<td><label>Nombre: </label> <p> <?php echo $nombre ?></p></td>
							<td><label>fecha de Nac. : </label> <p> <?php echo $fecha_nac; ?></p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="factura_detalle">
			<thead>
				<tr>
					
					<th width="50px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px"> Descuento</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">

			
				<tr>
					<td class="textcenter"><?php echo $cont;?></td>
					<td><?php echo $estudio;?></td>
					<td class="textright"><?php echo number_format($monto , 0,'.','.')?> GS;</td>
					<td class="textright"><?php echo number_format( $descuento, 0,'.','.')?> GS;</td>
				</tr>
			
				
			</tbody>
			<br />
           <tfoot style="border-top: 1px solid black; border-bottom: 1px solid black;">
			<th></th>
			<th></th>
			<th>Total Iva: 5%</th>
			<th>Total: <?php echo number_format($monto - $descuento, 0,'.','.')?> GS</th>
		   </tfoot>
	</table>
	<div>
		<p>Si usted tiene preguntas sobre esta factura, pongase en contacto con nombre, teléfono y Email</p>
		<p class="text-right"><b>Archivo Tributario</b></p>
	</div>
	
</div>

</body>

</html>
<?php
$html = ob_get_clean();
//echo $html;

require_once "../Library/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

//$dompdf->setPaper('letter');
$dompdf->setPaper('a4', 'portrait');



$dompdf->render();
$dompdf->stream('reporte-cliente.pdf', array('Attachment' => false));
$dompdf->stream($cedula."-".$Fecha);
$output = $dompdf->output();
file_put_contents("comprobante", $output);

?>
