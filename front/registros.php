<?php 
	include('../back/validar_sesion.php'); 
	include('../back/url.php'); 
	include('../back/function.php'); 

	$id=intval($_SESSION['id']);
	/*Hola*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('etiquetas/head.php'); ?>
</head>
<body id="panel">
	<h1 class="h3 mb-3 fw-normal text-center"><b><?php echo $_SESSION['nombre'] ?></b>! estas en las batallas Pokemon?</h1>
	<div class="row">
		<div class="col-md-6">
			<a href="javascript:history.back()" type="button" class="btn btn-success btn-lg btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
		</div>
		<div class="col-md-6" id="boton_salir">
			<a type="button" href="../back/salir.php" class="btn btn-danger btn-lg btn-block"><i class="fas fa-sign-out-alt"></i> Salir</a>
		</div>
	</div>
	<br>
	<table class="table" id="table_id">
	  <thead>
	    <tr>
	      <th scope="col">Usuarios</th>
	      <th scope="col">Equipo</th>
	      <th scope="col">Ganador</th>
	      <th scope="col">Fecha</th>
	    </tr>
	  </thead>
	  	<tbody>
			  	<?php 

	    		$obtener_registros=obtener_registros($id);

	    			while ($extraer_datos = mysqli_fetch_row($obtener_registros)) {

	    				$usuarios_BD= $extraer_datos[1];
                		$usuarios_divididos_BD=explode(', ', $usuarios_BD);

                		$equipo_BD= $extraer_datos[2];
                		$equipo_divididos=explode('/ ', $equipo_BD);

						$equipo1=$equipo_divididos[0];
						$equipo_final_oponente=explode(', ', $equipo1);

                		$equipo2=$equipo_divididos[1];
                		$equipo_final_mio=explode(', ', $equipo1);

                		$ganador_BD= $extraer_datos[3];
                		$fecha_BD= $extraer_datos[4];

                		

	    			?>

	    				<tr>
	    					<td scope="col">
	    						<div class="row">
	    							<div class="col-md-12"><?php echo $usuarios_divididos_BD[0] ?></div>
	    							<div class="col-md-12">VS</div>
	    							<div class="col-md-12"><?php echo $usuarios_divididos_BD[1] ?></div>
	    						</div>
	    					</td>
	    					<td scope="col">
	    						<div class="row">
	    							<div class="col-md-12">

	    								<?php	$obtenerPokemon=obtener_pokemon();

			                    	
			                    			for ($i=0; $i < count($equipo_final_oponente); $i++) { 
			                    				
			                    				$valor=$equipo_final_oponente[$i];		                    			

				                    		?>
		                    				
		                    				<img width="5%" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/dream-world/<?php echo $valor+1 ?>.svg" >

		                    			<?php } ?>
		                    		</div>
	    							<div class="col-md-12">
	    								<?php	$obtenerPokemon=obtener_pokemon();

			                    	
			                    			for ($i=0; $i < count($equipo_final_mio); $i++) { 
			                    				
			                    				$valor=$equipo_final_mio[$i];		                    			

				                    		?>
		                    				
		                    				<img width="5%" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/dream-world/<?php echo $valor+1 ?>.svg" >
										<?php } ?>

	    							</div>
	    						</div>
	    					</td>
	    					<td scope="col">
								<?php echo $ganador_BD ?>
	    					</td>	
		                    <td scope="col">
		                    	<?php echo $fecha_BD ?>
		                    </td>  
		                </tr>

					<?php } ?>
		</tbody>
	</table>
</body>
<?php include('etiquetas/js.php'); ?>
</html>