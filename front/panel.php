<?php 
	include('../back/validar_sesion.php'); 
	include('../back/url.php'); 
	include('../back/function.php'); 

	$id=intval($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('etiquetas/head.php'); ?>

	<script type="text/javascript">
		var URLactual = window.location.search;
		var respuesta = URLactual.split('=');
		var response = respuesta[1];
		if(response==='e'){
    		Swal.fire({
			  icon: 'error',
			  title: 'Hubo un error',
			  text: 'Vuelve a intentar!',
			  confirmButtonText: `Ok`,
			})
    	}
    	if(response==='o'){
			Swal.fire({
			  icon: 'success',
			  text: 'Eliminando...',
			  timer: 2000,
			  timerProgressBar: true
			}).then((result) => {
				window.location.href = './';
			})
    		
    	}
	</script>

</head>
<body id="panel">
	<h1 class="h3 mb-3 fw-normal text-center">Hola Bienvenida <b><?php echo $_SESSION['nombre'] ?></b>!</h1>
	<div class="row">
		<div class="col-md-6">
			<a href="equipo.php" type="button" class="btn btn-success btn-lg btn-block"><i class="fas fa-plus"></i> Agregar Equipo</a>
			<a href="competencia.php" type="button" class="btn btn-primary btn-lg btn-block"><i class="fas fa-fist-raised"></i> Combate Pokemon</a>
		</div>
		<div class="col-md-6" id="boton_salir">
			<a type="button" href="../back/salir.php" class="btn btn-danger btn-lg btn-block"><i class="fas fa-sign-out-alt"></i> Salir</a>
		</div>
	</div>
	<br>
	<table class="table" id="table_id">
	  <thead>
	    <tr>
	      <th scope="col">Nombre del equipo</th>
	      <th scope="col">Pokemon</th>
	      <th scope="col">Acciones</th>
	    </tr>
	  </thead>
		<tbody>
			  	<?php 

	    		$obtener_equipos=obtener_equipos($id);

	    			while ($extraer_datos = mysqli_fetch_row($obtener_equipos)) {
	    				$id_equipo_BD= $extraer_datos[0];

	    			?>

	    				<tr>
	    					<td scope="col">
	    						<?php 
		                    		$nombre_equipo_BD= $extraer_datos[2];
		                    		$favorito_BD= $extraer_datos[4];
		                    		
		                    		echo '<pre>'; print_r($nombre_equipo_BD); echo '</pre>';
		                    		if ($favorito_BD=="Si") { ?>
		                    			<i class="fas fa-star"></i> (Equipo favorito)
		                    		<?php }
		                    	?> 
	    					</td>
	    					<td scope="col">

	    						<div class="contenedor">
		    						<?php 
			                    		$nombre_equipo_BD= $extraer_datos[3];
			                    		$nombre_equipo_BD=explode(', ', $nombre_equipo_BD);
			                    		$obtenerPokemon=obtener_pokemon();

			                    		for ($i=0; $i < count($nombre_equipo_BD); $i++) { 
			                    			$valor=$nombre_equipo_BD[$i];	
			                    		?>

		                    					<img width="10%" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/dream-world/<?php echo $valor+1 ?>.svg" >
		                    					<?php /*echo $obtenerPokemon->results[$valor]->name;	*/		                    			
			                    		 } ?> 
			                    </div>

	    					</td>	
		                    <td scope="col">
		                    	<a type="button" href="../back/eliminar.php?id=<?php echo $id_equipo_BD;?>" id="eliminar_equipo" class="btn btn-danger btn-lg btn-block"><i class="fas fa-trash-alt"></i> Eliminar</a>
		                    </td>  
		                </tr>

					<?php } ?>
		</tbody>
	</table>
</body>
<?php include('etiquetas/js.php'); ?>
</html>
