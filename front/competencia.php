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
</head>
<body id="panel">
	<h1 class="h3 mb-3 fw-normal text-center"><b><?php echo $_SESSION['nombre'] ?></b>! Elegí a tu oponente</h1>
	<div class="row">
		<div class="col-md-6">
			<a href="javascript:history.back()" type="button" class="btn btn-success btn-lg btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
			<a href="registros.php" type="button" class="btn btn-primary btn-lg btn-block"><i class="fab fa-readme"></i> Ver registros de competencias</a>
		</div>
		<div class="col-md-6" id="boton_salir">
			<a type="button" href="../back/salir.php" class="btn btn-danger btn-lg btn-block"><i class="fas fa-sign-out-alt"></i> Salir</a>
		</div>
	</div>
	<br>
	<table class="table" id="table_id">
	  <thead>
	    <tr>
	      <th scope="col">Nombre del entrenador</th>
	      <th scope="col">Nombre del equipo</th>
	      <th scope="col">Pokemon</th>
	      <th scope="col">Acciones</th>
	    </tr>
	  </thead>
		<tbody>
			  	<?php 

	    		$obtener_oponentes=obtener_oponentes($id);
	    		//echo '<pre>'; print_r($obtener_oponentes); echo '</pre>';

	    			while ($extraer_datos = mysqli_fetch_row($obtener_oponentes)) {
	    				$id_oponente_BD= $extraer_datos[0];
	    				$id_usuario_oponente_BD= $extraer_datos[1];

	    			?>

	    				<tr>
	    					<td scope="col">
	    						<?php 
		                    		$nombre_oponente_BD= $extraer_datos[2];
		  
		                    		echo '<pre>'; print_r($nombre_oponente_BD); echo '</pre>';
		                    		
		                    	?> 
	    					</td>
	    					<td scope="col">
	    						<?php 
		                    		$nombre_equipo_BD= $extraer_datos[3];
		  
		                    		echo '<pre>'; print_r($nombre_equipo_BD); echo '</pre>';
		                    		
		                    	?> 
	    					</td>
	    					<td scope="col">

	    						<div class="contenedor">
		    						<?php 
			                    		$nombre_pokemon_BD= $extraer_datos[4];
			                    		$nombre_pokemon_BD=explode(', ', $nombre_pokemon_BD);
			                    		$obtenerPokemon=obtener_pokemon();

			                    	
		                    			for ($i=0; $i < count($nombre_pokemon_BD); $i++) { 
		                    				
		                    				$valor=$nombre_pokemon_BD[$i];		                    			

			                    		?>
		                    					<img width="10%" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/dream-world/<?php echo $valor+1 ?>.svg" >



		                    			<?php /*echo $obtenerPokemon->results[$valor]->name;*/	} ?> 
			                    </div>

	    					</td>	
		                    <td scope="col">
		                    	<a type="button" href="../back/combatir.php?id=<?php echo $id_usuario_oponente_BD;?>" class="btn btn-warning btn-lg btn-block"><i class="fas fa-fist-raised"></i> Combatir</a>
		                    </td>  
		                </tr>

					<?php } ?>
		</tbody>
	</table>
</body>
<?php include('etiquetas/js.php'); ?>
</html>
