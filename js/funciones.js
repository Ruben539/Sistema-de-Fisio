	function index(){
		this.ini = function(){
			console.log("iniciando");
			this.getIndicadores();
			
			

		}

		this.getIndicadores = function(){
	//Total de Pacientes diarios 
	$.ajax({
		statusCode:{
			404:function(){
				console.log("Esta Pagina no Existe");
			}
		},
		url:'../Libraries/servidor.php',
		method:'POST',
		data:{
			rq:"1"
		}
	}).done(function(datos){
	//Logica de respuesta  de los datos
	$("#idPacientesDiarios").text(parseInt(datos).toLocaleString());
});

	//Total de Pacientes mensuales 
	$.ajax({
		statusCode:{
			404:function(){
				console.log("Esta Pagina no Existe");
			}
		},
		url:'../Libraries/servidor.php',
		method:'POST',
		data:{
			rq:"2"
		}
	}).done(function(datos){
	//Logica de respuesta  de los datos
	$("#idPacientesMensuales").text(parseFloat(datos).toLocaleString());
});

//Total de Ingreso Diario 
$.ajax({
	statusCode:{
		404:function(){
			console.log("Esta Pagina no Existe");
		}
	},
	url:'../Libraries/servidor.php',
	method:'POST',
	data:{
		rq:"3"
	}
}).done(function(datos){
//Logica de respuesta  de los datos
$("#idMontoDiario").text(parseInt(datos).toLocaleString());
});

//Total de Ingreso Mensual 
$.ajax({
	statusCode:{
		404:function(){
			console.log("Esta Pagina no Existe");
		}
	},
	url:'../Libraries/servidor.php',
	method:'POST',
	data:{
		rq:"4"
	}
}).done(function(datos){
//Logica de respuesta  de los datos
$("#idMontoMensual").text(parseFloat(datos).toLocaleString());
});

	

// Consulta de la sentencia para recuperar los datos para las Notificaciones
			$.ajax({
				statusCode:{
					404:function(){
						console.log("Esta Pagina no Existe");
					}
				},
				url:'../Libraries/servidor.php',
				method:'POST',
				data:{
					rq:"26"
				}
			}).done(function(datos){
	//Logica de respuesta  de los datos
  $("#idNotificacion").text(parseFloat(datos).toLocaleString()+" "+"Pedidos Pendientes");
 
	if (datos == 0) {
		//alert("validacion nula");

	}else{

	Swal.fire({
  /*toast: true,*/
  position: 'bottom-end',
  title: 'Mensaje del Sistema !',
  text: 'Tiene un nuevo Pedido para Aprobar',
  imageUrl: '../images/recurso.png',
  imageWidth: 150,
  imageHeight: 70,
  imageAlt: 'Custom image',
  showConfirmButton: false,
  timer: 5000, 

});

	
	}
	
});

}


}

	//llave de la primera Clase principal

	var oIndex = new index();
	setTimeout(function(){oIndex.ini();}, 100);
