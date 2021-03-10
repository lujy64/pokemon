<?php 
	session_start();

	require('function.php');
	$id_usuario=intval($_SESSION['id']);
	$nombre=$_SESSION['nombre'];
	$id_usuario_oponente_BD=$_GET['id'];



	$obtener_competencia_oponente=obtener_competencia($id_usuario_oponente_BD);

	while ($extraer_datos = mysqli_fetch_row($obtener_competencia_oponente)) {
		$nombre_oponente_competencia_BD= $extraer_datos[2];
		$nombre_equipo_competencia_BD= $extraer_datos[3];
		$pokemon_competencia_BD= $extraer_datos[4];
	}




	$obtener_competencia=obtener_competencia($id_usuario);

	while ($extraer_datos_mios = mysqli_fetch_row($obtener_competencia)) {
		$nombre_equipo_competencia_mios_BD= $extraer_datos_mios[3];
		$pokemon_competencia_mios_BD= $extraer_datos_mios[4];
	}

	$usuarios= $nombre_oponente_competencia_BD.', '.$nombre;
	$equipos= $pokemon_competencia_BD.'/ '.$pokemon_competencia_mios_BD;
	$ganador= $nombre;


	$conexion=base_de_datos();

	$registros=agregar_registros($conexion, $usuarios, $equipos, $ganador);
	
	if ($registros=="ok") {
		header('Location: ../front/registros.php');
	} 

	

	
	
?>