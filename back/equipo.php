<?php 
	session_start();

	require('function.php');

	$nombre_entrenador=$_SESSION['nombre'];

	$nombre=$_POST['nombre'];
	//echo '<pre>'; print_r($nombre); echo '</pre>';
	

	$seleccion_favorito=$_POST['seleccion_favorito'];
	//echo '<pre>'; print_r($seleccion_favorito); echo '</pre>';

	$checks=$_POST['checks']; 
	$checks_array = implode(', ', $checks);
	//echo '<pre>'; print_r($checks_array); echo '</pre>';

	$conexion=base_de_datos();
	//echo '<pre>'; print_r($conexion); echo '</pre>';

	$id_usuario=intval($_SESSION['id']);
	//echo '<pre>'; print_r($_SESSION['id']); echo '</pre>';

	$buscar_equipos = mysqli_query($conexion, "SELECT * FROM equipo where id_usuario = '$id_usuario'");
	$resultado=0;
	$resultado2=0;

	mysqli_data_seek ($buscar_equipos, 0);

	while ($extraer_datos = mysqli_fetch_row($buscar_equipos)) {
        //echo '<pre>'; print_r($extraer_datos); echo '</pre>';

		$id_equipo_BD= $extraer_datos[0];
		$pokemon_BD= $extraer_datos[3];
		$nombre_BD= $extraer_datos[2];
		$favorito_BD= $extraer_datos[4];

		if ($seleccion_favorito===$favorito_BD) {
			$resultado++;
		} else {
			$resultado=0;
		}

		if ($nombre===$nombre_BD) {
			$resultado2++;
		} else {
			$resultado2=0;
		}

    }

		//echo '<pre>'; print_r($resultado2); echo '</pre>';

		if ($resultado2>0) {

			echo 'Equipo ya existente';

		} else {

			if ($seleccion_favorito=='Si') {

				if ($resultado>0) {
					

					$actualizar_equipos = mysqli_query($conexion, "UPDATE `equipo` SET `favorito`='No' WHERE id_usuario ='$id_usuario'");

					if ($actualizar_equipos=='1') {

						$actualizar_oponente=actualizar_oponente($conexion, $id_usuario, $nombre, $nombre_entrenador, $checks_array);
						//echo '<pre>'; print_r($actualizar_oponente); echo '</pre>';

						$agregar_equipo=agregar_equipos($conexion, $id_usuario, $nombre, $seleccion_favorito, $checks_array);
						echo $agregar_equipo;

					} else {

						$mensaje='Hubo un error';
						echo $mensaje;
					}

				} else {

					$actualizar_oponente=actualizar_oponente($conexion, $id_usuario, $nombre, $nombre_entrenador, $checks_array);
					//echo '<pre>'; print_r($actualizar_oponente); echo '</pre>';

					$agregar_equipo=agregar_equipos($conexion, $id_usuario, $nombre, $seleccion_favorito, $checks_array);
					echo $agregar_equipo;
				}
				
			} else {
				$agregar_equipo=agregar_equipos($conexion, $id_usuario, $nombre, $seleccion_favorito, $checks_array);
				echo $agregar_equipo;
			}
		}
	
?>