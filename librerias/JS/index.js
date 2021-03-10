$(document).ready(function() {
  $('#table_id').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});


$(function () {
    $('#registrar').on('click', function () {
        var nombre = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var pass = document.getElementById('pass').value;
        if (nombre.length == 0 || email.length == 0 || pass.length == 0 ) {
        	Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Complete todos los campos!'
			})
        }else{
        	$.ajax({
	            url: '../back/registrar_usuarios.php',
	            data: {
	                nombre: nombre,
	                email: email,
	                pass: pass
	            },
	            type:  'post', 
	            beforeSend: function () {
	                    $("#registrar").html("Cargando...");
	            },
	            success:  function (response) { 	
	            	if(response==='Su email ya se encuentra registrado'){
	            		Swal.fire({
						  icon: 'warning',
						  title: 'Cuenta existente',
						  text: 'Su email ya se encuentra registrado!',
						  confirmButtonText: `Ingresar`,
						}).then((result) => {
							window.location.href = './../';
						})
	            	}else{
	            		if (response==='Su cuenta se creo con exito') {
	            			Swal.fire({
							  icon: 'success',
							  title: 'Cuenta creada correctamente',
							  text: 'Cargando...',
							  timer: 2000,
							  timerProgressBar: true,
							  confirmButtonText: false,
							}).then((result) => {
								window.location.href = 'panel.php';
							})
	            		}else{
	            			Swal.fire({
							  icon: 'error',
							  title: 'Hubo un error',
							  text: 'Vuelva a intentar mas tarde!',
							  confirmButtonText: `Ok`,
							})
	            		}
	            	}
	            console.log("response", response);
	            }
	        });
        	
        }
        
	});

	$('#ingresar').on('click', function () {
        var email = document.getElementById('email').value;
        //console.log("email", email);
        var pass = document.getElementById('pass').value;
        //console.log("pass", pass);
        if (email.length == 0 || pass.length == 0 ) {
        	Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Complete todos los campos!'
			})
        }else{
        	$.ajax({
	            url: 'back/ingresar.php',
	            data: {
	                email: email,
	                pass: pass
	            },
	            type:  'post', 
	            beforeSend: function () {
	                    $("#ingresar").html("Cargando...");
	            },
	            success:  function (response) { 	
	            	if(response==='Contraseña incorrecta'){
	            		Swal.fire({
						  icon: 'error',
						  title: 'Contraseña incorrecta',
						  text: 'Vuelve a intentar!',
						  confirmButtonText: `Ok`,
						})
	            	}else{
	            		if (response==='Contraseña coinciden') {
	            			Swal.fire({
							  icon: 'success',
							  text: 'Iniciando...',
							  timer: 2000,
							  timerProgressBar: true
							}).then((result) => {
								window.location.href = 'front/panel.php';
							})
	            		}else{
	            			Swal.fire({
							  icon: 'error',
							  title: 'No esta registrado',
							  confirmButtonText: `Ok`,
							})
	            		}
	            	}
	            }
	        });
        	
        }
        
	});

	$('#agregar_equipo').on('click', function () {

        var nombre = document.getElementById('nombre').value;
        var seleccion_favorito = document.getElementById('seleccion_favorito').value;
        var checks = $('[name="checks[]"]:checked').map(function(){
        	
	      return this.value;
	    }).get();

        if (nombre.length == 0 || seleccion_favorito.length == 0 || checks.length == 0 ) {
        	Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Complete todos los campos!'
			})
        }else{

        	if (checks.length>5) {
        		Swal.fire({
				  icon: 'warning',
				  title: '¡Ojo!',
				  text: 'Solo puede seleccionar hasta 5 pokemon!'
				})
        	}else{
	        	$.ajax({
		            url: '../back/equipo.php',
		            data: {
		                nombre: nombre,
		                seleccion_favorito: seleccion_favorito,
		                checks: checks
		            },
		            type:  'post', 
		            beforeSend: function () {
		                    $("#agregar_equipo").html("Por favor, espere...");
		            },
		            success:  function (response) { 	
		            	//console.log("response", response);
		            	if(response==='Equipo ya existente'){
		            		Swal.fire({
							  icon: 'warning',
							  title: 'Equipo ya existente',
							  confirmButtonText: `Ok`
							}).then((result) => {
								window.location.href = window.location.href;
							})
		            	}else{
		            		if (response==='Hubo un error') {
		            			Swal.fire({
								  icon: 'error',
								  title: 'Hubo un error',
								  text: 'Vuelve a intentar!',
								  confirmButtonText: `Ok`
								}).then((result) => {
									window.location.href = window.location.href;
								})
		            		}else{
		            			Swal.fire({
								  icon: 'success',
								  text: 'Creando equipo...',
								  timer: 2000,
								  timerProgressBar: true
								}).then((result) => {
									window.location.href = './panel.php';
								})
		            			
		            		}
		            	}
		            }
		        });
        	}
        }
        
	});
});