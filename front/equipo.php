<?php 
	include('../back/validar_sesion.php'); 
	include('../back/url.php'); 
	include('../back/function.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('etiquetas/head.php'); ?>
</head>
<body id="panel">
	<h1 class="h3 mb-3 fw-normal text-center"><b><?php echo $_SESSION['nombre'] ?></b>! Crea tu nuevo equipo Pokemon</h1>
	<div class="row">
		<div class="col-md-6">
			<a href="javascript:history.back()" type="button" class="btn btn-success btn-lg btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
		</div>
		<div class="col-md-6" id="boton_salir">
			<a type="button" href="../back/salir.php" class="btn btn-danger btn-lg btn-block"><i class="fas fa-sign-out-alt"></i> Salir</a>
		</div>
	</div>
	<br>
	<div>
		<div class="col-md-12 row">
			<div class="col-md-3">
				<label for="nombre">Nombre del equipo:</label>
			</div>
			<div class="col-md-9">
				<input type="text" id="nombre" class="form-control" placeholder="Nombre del equipo" required="">
			</div>
		</div>
		<div class="col-md-12 row">
			<div class="col-md-3">
				<label for="seleccion_favorito">Equipo favorito:</label>
			</div>
			<div class="col-md-9">
				<select class="form-select" id="seleccion_favorito" aria-label="Default select example">
				  <option selected value="Si">Si</option>
				  <option value="No">No</option>
				</select>
			</div>
		</div>
		<br>
		<table class="table table-responsive" id="table_id">
		  <thead>
		    <tr>
		      <th scope="col">Pokemon</th>
		      <th scope="col">Habilidades</th>
		      <th scope="col">Tipo</th>
		      <th scope="col">Elegir</th>
		    </tr>
		  </thead>
			<tbody>
			  	<?php 

	    		$obtenerPokemon=obtener_pokemon();

		    		for ($i=0; $i < count($obtenerPokemon->results); $i++) { 
		    			$obtener_info_Pokemon=obtener_info_pokemon($i+1);
		    			$id_imagen=$i+1;
		    		?>
		    			<tr>
		                    <td scope="col">
		                    	<img width="10%" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/dream-world/<?php echo $id_imagen ?>.svg" >
		                    	<?php echo $obtenerPokemon->results[$i]->name; ?> 
		                    </td>	
		                    <td scope="col">
		                    	<?php 
		                    		for ($j=0; $j < count($obtener_info_Pokemon->abilities); $j++) {
		                    			echo '<pre>'; print_r($obtener_info_Pokemon->abilities[$j]->ability->name); echo '</pre>';

		                    		} 
		                    	?> 
		                    </td>
		                    <td scope="col">
		                    	<?php 
		                    		for ($j=0; $j < count($obtener_info_Pokemon->types); $j++) {
		                    			echo '<pre>'; print_r($obtener_info_Pokemon->types[$j]->type->name); echo '</pre>';

		                    		} 
		                    	?> 
		                    </td>   
		                    <td scope="col">
			                    <div class="form-check">
								    <input type="checkbox" name="checks[]" class="form-check-input" value="<?php echo $i;?>">
								</div>
		                    </td>  
		                </tr>
	                <?php } 

	            ?>
			</tbody>
		</table>
		<div class="col-md-12" id="boton_salir">
			<a type="button" id="agregar_equipo" class="btn btn-danger btn-lg btn-block"><i class="fas fa-sign-out-alt"></i> Crear</a>
		</div>
	</div>
	
</body>
<?php include('etiquetas/js.php'); ?>
</html>
