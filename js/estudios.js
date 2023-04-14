

function liberarEstudio(id){
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"../Controllers/eliminarEstudio.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Eliminado con Exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "../Templates/servicios.php";                          
					}
				})
				
			}else{
				Swal.fire({
					type: 'error',
					title: 'Error al Eliminar',                          
				});
			}
		}
	});
}


function EliminarEstudio(id){
	Swal.fire({
		title: 'Desea Eliminar el Estudio ?',
		text: "Eliminar Estudio "+id+" del Sistema!",
		imageUrl: '../assets/img/fisio2.png',
		imageWidth: 250,
		imageHeight: 250,
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Eliminar!'
	}).then((result) => {
		if (result.value) {
			liberarEstudio(id);
		}
	})
}

function activarUsuario(id){
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"Helpers/Activar_Usu.php",
		data:cadena,
		success: function(r){
			if(r == 1){
				Swal.fire({
					type: 'success',                          
					title: 'Reestablecido con Exito!'
				}).then((result) => {
					if (result.value) {
						window.location.href = "usuario";                          
					}
				})
				
			}else{
				Swal.fire({
					type: 'error',
					title: 'Error al Reestablecer',                          
				});	
			}
		}
	});
}

function activarDatos(id){
	Swal.fire({
		title: 'Desea Reestablecer el Usuario ?',
		text: "Reestablecer Usuario "+id+" del Sistema!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Reestablecer!'
	}).then((result) => {
		if (result.value) {
			activarUsuario(id);
		}
	})
}

